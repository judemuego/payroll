<?php

namespace App\Http\Controllers;

use App\Compensations;
use App\EmployeeBenefits;
use Auth;
use Illuminate\Http\Request;
use App\Classes\Computation\Payroll\Salary;

class CompensationsController extends Controller
{
    public function save(Request $request, $id) {

        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;
        $request['government_mandated_benefits'] = 1;
        $request['other_company_benefits'] = 1;

        $gov_benefits_id = $request->government_mandated['benefits_id'];
        $gov_amount = $request->government_mandated['amount'];
        $com_benefits_id = $request->other_company['benefits_id'];
        $com_amount = $request->other_company['amount'];
        $employee_id = $request->employee_id;

        $employment = Compensations::where('employee_id', $employee_id)->count();
        if($employment === 0) {
            $output = 'saved';
            Compensations::create($request->all());
        }
        else {
            $output = "updated";
            Compensations::where('employee_id', $employee_id)->update($request->except('_token','government_mandated', 'other_company', 'created_by'));
        }

        if(($gov_benefits_id !== '' && $gov_benefits_id !== null) && ($gov_amount !== '' && $gov_amount !== null)) {
            $gov_benefits_count = EmployeeBenefits::where('employee_id', $employee_id)->where('benefits_id', $gov_benefits_id)->count();
            
            
            if($gov_benefits_count === 0) {
                
                $gov_data = array(
                    "benefits_id" => $gov_benefits_id,
                    "amount" => $gov_amount,
                    "employee_id" => $employee_id,
                    "type" => "government_mandated",
                    "created_by" => Auth::user()->id,
                    "updated_by" => Auth::user()->id
                );

                EmployeeBenefits::create($gov_data);
            }
            else {
                
                $gov_data = array(
                    "benefits_id" => $gov_benefits_id,
                    "amount" => $gov_amount,
                    "employee_id" => $employee_id,
                    "type" => "government_mandated",
                    "updated_by" => Auth::user()->id
                );

                EmployeeBenefits::where('employee_id', $employee_id)->where('benefits_id', $gov_benefits_id)->update($gov_data);
            }
        }
        else {
            $output = "Invalid Action 1";
        }

        
        if(($com_benefits_id !== '' && $com_benefits_id !== null) && ($com_amount !== '' && $com_amount !== null)) {
            $com_benefits_count = EmployeeBenefits::where('employee_id', $employee_id)->where('benefits_id', $com_benefits_id)->count();
            
            if($com_benefits_count === 0) {
                $com_data = array(
                    "benefits_id" => $com_benefits_id,
                    "amount" => $com_amount,
                    "employee_id" => $employee_id,
                    "type" => "other",
                    "created_by" => Auth::user()->id,
                    "updated_by" => Auth::user()->id
                );

                EmployeeBenefits::create($com_data);
            }
            else {
                $com_data = array(
                    "benefits_id" => $com_benefits_id,
                    "amount" => $com_amount,
                    "employee_id" => $employee_id,
                    "type" => "other",
                    "updated_by" => Auth::user()->id
                );

                EmployeeBenefits::where('employee_id', $employee_id)->where('benefits_id', $com_benefits_id)->update($com_data);
            }
        }
        else {
            $output = "Invalid Action 2";
        }
        return $output;
    }
    
    public function getGovernmentMandatedRecord($id) {
        if(request()->ajax()) {
            return datatables()->of(EmployeeBenefits::with('benefits')->where('employee_id', $id)->where('type', 'government_mandated')->orderBy('id', 'desc')->get())
            ->addIndexColumn()
            ->make(true);
        }
    }
    
    public function getCompanyBenefits($id) {
        if(request()->ajax()) {
            return datatables()->of(EmployeeBenefits::with('benefits')->where('employee_id', $id)->where('type', 'other')->orderBy('id', 'desc')->get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            EmployeeBenefits::find($item)->delete();
        }
        
        return 'Record Deleted';
    }
    public function salary(Request $request) {

        $salary = new Salary;

        $entry = $request->entry;
        $type = $request->type;

        $data = array(
            "annual"=>$salary->annual($entry, $type),
            "monthly"=>$salary->monthly($entry, $type),
            "semi_monthly"=>$salary->semi_monthly($entry, $type),
            "weekly"=>$salary->weekly($entry, $type),
            "daily"=>$salary->daily($entry, $type),
            "hourly"=>$salary->hourly($entry, $type),
        );

        return response()->json(compact('data'));
    }
}
