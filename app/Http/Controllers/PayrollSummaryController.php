<?php

namespace App\Http\Controllers;

use Auth;
use View;
use App\Employment;
use App\EmployeeInformation;
use App\Compensations;
use App\Earnings;
use App\Deductions;
use App\SSS;
use App\WithholdingTax;
use App\PayrollSummary;
use App\PayrollSummaryDetails;
use App\PayrollCalendar;
use App\EarningsTransaction;
use App\DeductionsTransaction;
use Illuminate\Http\Request;

use App\Classes\Payroll\PayrollSummary as Summary;
use App\Classes\Computation\Payroll\SSS as SSS_Benefits;
use App\Classes\Computation\Payroll\WithholdingTax as WithholdingTax_Benefits;
use App\Classes\Computation\Payroll\Earnings as EarningsTotal;
use App\Classes\Computation\Payroll\Deductions as DeductionsTotal;
use App\Classes\Computation\Payroll\Pagibig;
use App\Classes\Computation\Payroll\Philhealth;
use App\Classes\Computation\Payroll\General;
use App\Classes\Computation\Payroll\Taxable_Amount;
use App\Classes\Computation\Payroll\NetPay;

use Carbon\Carbon;
use Illuminate\Support\Arr;

class PayrollSummaryController extends Controller
{
    protected $computation, $withholding_tax, $taxable_amount, $netpay, $summary, $sss_benefits, $pagibig_benefits, $philhealth_benefits, $earnings, $deductions;

    public function __construct() 
    {
        $this->computation = new General();
        $this->withholding_tax = new WithholdingTax_Benefits();
        $this->taxable_amount = new Taxable_Amount();
        $this->netpay = new NetPay();
        $this->summary = new Summary();
        $this->sss_benefits = new SSS_Benefits();
        $this->pagibig_benefits = new Pagibig();
        $this->philhealt_benefits = new Philhealth();
        $this->earnings = new EarningsTotal();
        $this->deductions = new DeductionsTotal();
    }

    public function index() {
        return view('backend.pages.transaction.payroll.summary', ["type"=>"full-view"]);
    }
    
    public function payslip() {
        return view('backend.pages.transaction.payroll.payslip');
    }
    
    public function save(Request $request)
    {
        $validate = $request->validate([
            'type' => 'required',
            'amount' => 'required'
        ]);

        if($request->module === "earning") {
            $data = array(
                "employee_id" => $request->employee_id,
                "sequence_no" => $request->sequence_no,
                "earning_id" => $request->type,
                "rate" => "-",
                "hours" => "-",
                "total" => $request->amount,
                "status" => 1,
                "workstation_id" => Auth::user()->workstation_id,
                "created_by" => Auth::user()->id,
                "updated_by" => Auth::user()->id,
            );

            EarningsTransaction::create($data);
            
            $this->update_details($request->sequence_no, $request->employee_id, $request->type);

        }
        else if($request->module === "deduction") {
            $data = array(
                "employee_id" => $request->employee_id,
                "sequence_no" => $request->sequence_no,
                "deduction_id" => $request->type,
                "rate" => "-",
                "hours" => "-",
                "total" => $request->amount,
                "status" => 1,
                "workstation_id" => Auth::user()->workstation_id,
                "created_by" => Auth::user()->id,
                "updated_by" => Auth::user()->id,
            );

            DeductionsTransaction::create($data);
        }
        

        return response()->json(compact('validate'));
    }

    public function get() {
        if(request()->ajax()) {
            return datatables()->of(
                PayrollSummary::selectRaw('payroll_summaries.id,
                                        payroll_summaries.sequence_no,
                                        payroll_summaries.schedule_type,
                                        payroll_summaries.payroll_period,
                                        SUM(CASE WHEN payroll_summary_details.status = 1 THEN 1 ELSE 0 END) no_of_employee,
                                        SUM(CASE WHEN payroll_summary_details.status = 1 THEN payroll_summary_details.gross_earnings ELSE 0 END) amount,
                                        payroll_summaries.status')
                                        ->leftJoin('payroll_summary_details', 'payroll_summary_details.sequence_no', '=', 'payroll_summaries.sequence_no')
                                        ->where('payroll_summaries.status', "!=", 1)
                                        ->groupBy('payroll_summary_details.sequence_no')
                                        ->get()
            )
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function get_history() {
        if(request()->ajax()) {
            return datatables()->of(
                PayrollSummary::selectRaw('payroll_summaries.id,
                                        payroll_summaries.sequence_no,
                                        payroll_summaries.schedule_type,
                                        payroll_summaries.payroll_period,
                                        SUM(CASE WHEN payroll_summary_details.status = 1 THEN 1 ELSE 0 END) no_of_employee,
                                        SUM(CASE WHEN payroll_summary_details.status = 1 THEN payroll_summary_details.gross_earnings ELSE 0 END) amount,
                                        payroll_summaries.status')
                                        ->leftJoin('payroll_summary_details', 'payroll_summary_details.sequence_no', '=', 'payroll_summaries.sequence_no')
                                        ->where('payroll_summaries.status', 1)
                                        ->groupBy('payroll_summary_details.sequence_no')
                                        ->get()
            )
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function get_details($sequence_no) {
        if(request()->ajax()) {
            return datatables()->of(
                PayrollSummaryDetails::with('employee')->where('sequence_no', $sequence_no)->get()
            )
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function get_summary() {
        $schedule = PayrollCalendar::get();

        $data = array();
        $data_2 = array();
        $summary_details_data = array();

        foreach($schedule as $sched) {
            $no_of_employee = Employment::where('payroll_calendar_id', $sched->type)->count();
            $hourly_rate = Compensations::first()->hourly_salary;
            
            if($sched->type === 1) {
                $startdate = $sched->start_date;
                $endate = $sched->end_date;
                $payment_date = $sched->payment_date;
                $today = Carbon::now()->format('Y-m-d');

                $start = strtotime($startdate);
                $set = strtotime($endate);
                $set2 = strtotime($endate);
                $end = strtotime($today);

                $new_payment = strtotime($payment_date);

                while($set < $end)
                {
                    $amount_total = $this->summary->query($start, $set, $sched->type)->sum('total_salary');
                    
                    $summary_details = $this->summary->get_summary_details($start, $set, $sched->type);

                    foreach($summary_details as $details) {
                        $basic_salary = $details->total_salary;

                        $sss = $this->sss_benefits->getValue($basic_salary)->ee;
                        $pagibig = $this->pagibig_benefits->getValue($basic_salary);
                        $philhealth = $this->philhealt_benefits->getValue($basic_salary);
                        $tax = $this->withholding_tax->getValue($basic_salary, $sched->type)->fix_tax;
                        $netpay =  $this->computation->deduction($sss, $pagibig, $philhealth, $basic_salary, $tax);

                        if(PayrollSummaryDetails::where('employee_id', $details->id)->where('sequence_no', "M-".date('mdY', $set))->count() === 0) {
                            array_push($summary_details_data, array(
                                "employee_id" => $details->id,
                                "sequence_no" => "M-".date('mdY', $set),
                                "gross_earnings" => $basic_salary,
                                "sss" => $sss,
                                "pagibig" => $pagibig,
                                "philhealth" => $philhealth,
                                "tax" => $tax,
                                "net_pay" => $netpay,
                                "status" => 1,
                                "workstation_id" => Auth::user()->workstation_id,
                                "created_by" => Auth::user()->id,
                                "updated_by" => Auth::user()->id,
                                "rate" => $details->rate,
                                "hours" => $details->hours
                            ));
                        }
                    }

                    $start = Carbon::parse(date('Y-m-d', $start));
                    $set = Carbon::parse(date('Y-m-d', $set));
                    $set2 = Carbon::parse(date('Y-m-d', $set2));

                    $new_payment = Carbon::parse(date('Y-m-d', $new_payment));
                    
                    if($this->summary->summaryWholeCount($set->format('Y-m-d'), 1, "M-".$set->format('mdY')) === 0) {
                        $input_data = array(
                            "sequence_no" => "M-".$set->format('mdY'),
                            "schedule_type" => 1,
                            "period_start" => $start->format('Y-m-d'),
                            "payroll_period" => $set->format('Y-m-d'),
                            "pay_date" => $new_payment->format('Y-m-d'),
                            "status" => 0,
                            "workstation_id" => Auth::user()->workstation_id,
                            "created_by" => Auth::user()->id,
                            "updated_by" => Auth::user()->id,
                            "created_at" => date('Y-m-d h:i:s'),
                            "updated_at" => date('Y-m-d h:i:s')
                        );

                        if($this->summary->summaryPeriodCount("M-".$set->format('mdY'), 1) === 0) {
                            array_push($data, $input_data);
                        }
                        else {
                            array_push($data_2, $input_data);
                        }
                    }

                    if((intval($set->format('m'))) === 1 && (intval($set->format('d'))) > 28) {
                        $new_payment = strtotime($new_payment->addMonth());

                        $start = strtotime($start->addMonth());
                        $set = strtotime($set->add('25 days')->endOfMonth());
                        $set2 = strtotime($set2->format('Y-m-d'));
                    }
                    else if((intval($set->format('m'))) === 2 && (intval($set->format('d'))) >= 28) {
                        $new_payment = strtotime($new_payment->addMonth());
                        
                        $start = strtotime($start->addMonth());
                        $set = strtotime($set2->addMonth(2));
                        $set2 = $set;
                    }
                    else {
                        if((intval(date('d', strtotime($endate)))) > 30) {
                            $new_payment = strtotime($new_payment->addMonth());

                            $start = strtotime($start->addMonth());
                            $set = strtotime($set2->add("30 days")->endOfMonth());
                            $set2 = strtotime($set2);
                        }
                        else {
                            $new_payment = strtotime($new_payment->addMonth());

                            $start = strtotime($start->addMonth());
                            $set = strtotime($set2->addMonth());
                            $set2 = strtotime($set2);
                        }
                    }

                }
            }
            
        }
        $this->summary->insertSummary($data);
        $this->summary->insertSummaryDetails($summary_details_data);
        // $this->summary->updateSummary($data_2);

    }

    public function get_earnings_and_deductions(Request $request) {

        $employee = EmployeeInformation::with('employments_tab')->where('id', $request->employee_id)->firstOrFail();
        $summary = PayrollSummary::with('calendar')->where('sequence_no', $request->sequence_no)->firstOrFail();

        $earnings = EarningsTransaction::with('earning')->where('sequence_no', $request->sequence_no)->where('employee_id', $request->employee_id)->get();
        $deductions = DeductionsTransaction::with('deduction')->where('sequence_no', $request->sequence_no)->where('employee_id', $request->employee_id)->get();

        $earnings_total = $this->earnings->getValue($request->sequence_no, $request->employee_id);
        $deductions_total = $this->deductions->getValue($request->sequence_no, $request->employee_id);

        $taxable_amount = $this->taxable_amount->getValue($this->earnings->getTaxable($request->sequence_no, $request->employee_id), $this->deductions->getValue($request->sequence_no, $request->employee_id));

        if($taxable_amount < 0) {
            $withholding_tax = $this->withholding_tax->getValue(0, $request->schedule_type)->fix_tax;
        }
        else {
            $withholding_tax = $this->withholding_tax->getValue($taxable_amount, $request->schedule_type)->fix_tax;
        }

        $netpay = $this->netpay->getValue($earnings_total, $deductions_total, $withholding_tax);

        return response()->json(compact('employee', 'earnings', 'deductions', 'earnings_total', 'deductions_total', 'taxable_amount', 'withholding_tax', 'netpay', 'summary'));
    }

    public function get_earnings() {
        $earnings = Earnings::get();

        return response()->json(compact('earnings'));
    }

    public function get_deductions() {
        $deductions = Deductions::get();

        return response()->json(compact('deductions'));
    }

    public function update_status(Request $request) {
        PayrollSummary::where('id', $request->id)->update(['status' => $request->status]);
    }
    
    public function update_details_status(Request $request) {
        PayrollSummaryDetails::where('id', $request->id)->update(['status' => $request->status]);
    }

    public function get_overall(Request $request) {
        $summary_details = PayrollSummaryDetails::where('sequence_no', $request->data['sequence_no'])->where('status', 1)->get();

        foreach($summary_details as $details) {
            if(PayrollSummaryDetails::where('employee_id', $details->employee_id)->where('sequence_no', $request->data['sequence_no'])->where('gross_earnings', $details->gross_earnings)->count() === 0) {
                $this->update_details($request->sequence_no, $details->employee_id, $request->type);
            }
        }

        $total = array(
            "gross" => $summary_details->sum('gross_earnings'),
            "sss" => $summary_details->sum('sss'),
            "philhealth" => $summary_details->sum('philhealth'),
            "pagibig" => $summary_details->sum('pagibig'),
            "tax" => $summary_details->sum('tax'),
            "net_pay" => $summary_details->sum('net_pay')
        );

        return response()->json(compact('total'));
    }

    public function show(Request $request) {
        $summary_details = PayrollSummaryDetails::where('employee_id', $request->employee_id)->where('sequence_no', $request->sequence_no)->firstOrFail();
        $previous = PayrollSummaryDetails::where('id', '<', $summary_details->id)->where('sequence_no', $request->sequence_no)->orderBy('id','desc')->first();
        $next = PayrollSummaryDetails::where('id', '>', $summary_details->id)->where('sequence_no', $request->sequence_no)->orderBy('id','asc')->first();
    
        return response()->json(compact('summary_details', 'previous', 'next'));
    }

    public function update_details($sequence_no, $employee_id, $type) {
        $earnings_total = $this->earnings->getValue($sequence_no, $employee_id);
        $deductions_total = $this->deductions->getValue($sequence_no, $employee_id);
        $taxable_amount = $this->taxable_amount->getValue($this->earnings->getTaxable($sequence_no, $employee_id), $this->deductions->getTaxable($sequence_no, $employee_id));

        if($taxable_amount < 0) {
            $withholding_tax = $this->withholding_tax->getValue(0, $type)->fix_tax;
        }
        else {
            $withholding_tax = $this->withholding_tax->getValue($taxable_amount, $type)->fix_tax;
        }

        $netpay = $this->netpay->getValue($earnings_total, $deductions_total, 0);

        PayrollSummaryDetails::where('sequence_no', $sequence_no)->where('employee_id', $employee_id)->update(['gross_earnings' => $earnings_total, 'net_pay' => $netpay]);
    }
}
