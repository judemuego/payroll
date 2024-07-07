<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use DatePeriod;
use DateInterval;
use App\TimeLogs;
use App\Schedulings;
use App\Earnings;
use App\Departments;
use App\EmployeeInformation;
use App\Classes\TimeKeeping\TimeLog;
use App\Classes\Computation\TimeLog as TimeComputation;
use Illuminate\Http\Request;

class TimeLogsController extends Controller
{   
    public function index()
    {
        $departments = Departments::get();
        return view('backend.pages.transaction.timekeeping.time_logs', ["type"=>"full-view"], compact('departments'));
    }
    public function get($department, $first, $last) {
        
        $timelog = new TimeLog;
        $script = $timelog->query($first, $last);

        if(request()->ajax()) {
            if($department === "all") {
                $record = EmployeeInformation::selectRaw($script)
                ->leftJoin('time_logs', 'employees.id', '=', 'time_logs.employee_id')
                ->leftJoin('earnings', 'earnings.id', '=', 'time_logs.type')
                ->groupBy("employees.id")
                ->get();
            }
            else {
                $record = EmployeeInformation::selectRaw($script)
                ->leftJoin('time_logs', 'employees.id', '=', 'time_logs.employee_id')
                ->leftJoin('earnings', 'earnings.id', '=', 'time_logs.type')
                ->leftJoin('employments', 'employees.id', '=', 'employments.employee_id')
                ->where('employments.department_id', '=', $department)
                ->groupBy("employees.id")
                ->get();
            }

            return datatables()->of(
                $record
            )
            ->addIndexColumn()
            ->make(true);
        }
    }
    
    public function save(Request $request)
    {  
        foreach($request->record as $record) {
            if($record['type'] !== null && $record['time_in'] !== null && $record['time_out'] !== null) {
                $time_logs = TimeLogs::where('employee_id', $record['employee_id'])->where('date', $record['date'])->count();
                if($time_logs === 0) {
                    $record['workstation_id'] = Auth::user()->workstation_id;
                    $record['created_by'] = Auth::user()->id;
                    $record['updated_by'] = Auth::user()->id;
            
                    TimeLogs::create($record);
                }
                else {
                    TimeLogs::where('employee_id', $record['employee_id'])->where('date', $record['date'])->update($record);
                }
            } 
        }

        return response()->json();
    }
    
    public function plot($employee_id, $first, $last) {

        $timelog = new TimeLog;
        $script = $timelog->time_logs($first, $last);

        $record = TimeLogs::selectRaw($script)
        ->where("time_logs.employee_id", "=", $employee_id)
        ->get();

        return datatables()->of(
            $record
        )
        ->addIndexColumn()
        ->make(true);
    }

    public function get_earnings(Request $request) {
        $earnings = Earnings::get();
        
        return response()->json(compact('earnings'));
    }

    public function update_status(Request $request) {
        TimeLogs::where('id', $request->id)->update(['status'=>$request->status]);
    }

    public function cross_matching(Request $request) {

        $computation = new TimeComputation;
        
        $date = $request->data['date'];
        $employee_id = $request->data['employee_id'];
        $time_in = $request->data['time_in'];
        $time_out = $request->data['time_out'];
        $type = $request->data['type'];

        $in = strtotime($time_in);
        $out = strtotime($time_out);

        $data = null;
        $schedule = Schedulings::where('date', $date)->where('employee_id', $employee_id)->where('type', 0);

        if($schedule->count() !== 0) {
            $schedule = $schedule->firstOrFail();
            
            $start = strtotime($schedule->start_time);
            $end = strtotime($schedule->end_time);
            
            $late_hours = $computation->late_hours($in, $start);
            $overtime = $computation->overtime($out, $end);
            $undertime = $computation->undertime($out, $end);
            $sub_total = $computation->subtotal($start, $end, $out);
            $total_hours = $computation->total_hours($sub_total, $late_hours, $overtime, $undertime);
            
            $time_logs = TimeLogs::where('date', $date)->where('employee_id', $employee_id);
            
            if($time_logs->count() === 0 ) {
                $data = array(
                    "employee_id" => $employee_id,
                    "date" => $date,
                    "time_in" => $time_in,
                    "time_out" => $time_out,
                    "total_hours" => $total_hours,
                    "break_hours" => 0,
                    "ot_hours" => $overtime,
                    "late_hours" => $late_hours,
                    "undertime" => $undertime,
                    "type" => $type,
                    "status" => 0,
                    "schedule_status" => 1,
                    "workstation_id" => Auth::user()->workstation_id,
                    "created_by" => Auth::user()->id,
                    "updated_by" => Auth::user()->id
                );
                
                TimeLogs::create($data);
            }
            else {
                $time_logs = $time_logs->firstOrFail();

                $data = array(
                    "time_in" => $time_in,
                    "time_out" => $time_out,
                    "total_hours" => $total_hours,
                    "ot_hours" => $overtime,
                    "late_hours" => $late_hours,
                    "undertime" => $undertime,
                    "type" => $type,
                    "schedule_status" => 1
                );

                TimeLogs::where('date', $request->data['date'])->where('employee_id', $request->data['employee_id'])->update($data);
            }
        }
        else {
            $time_logs = TimeLogs::where('date', $date)->where('employee_id', $employee_id);
            if($time_logs->count() === 0 ) {
                $data = array(
                    "employee_id" => $employee_id,
                    "date" => $date,
                    "time_in" => $time_in,
                    "time_out" => $time_out,
                    "total_hours" => $request->data['total_hours'],
                    "break_hours" => 0,
                    "ot_hours" => $request->data['ot_hours'],
                    "late_hours" => $request->data['late_hours'],
                    "undertime" => $request->data['undertime'],
                    "type" => $type,
                    "status" => 0,
                    "schedule_status" => 2,
                    "workstation_id" => Auth::user()->workstation_id,
                    "created_by" => Auth::user()->id,
                    "updated_by" => Auth::user()->id
                );

                TimeLogs::create($data);
            }
            else {
                $data = array(
                    "time_in" => $time_in,
                    "time_out" => $time_out,
                    "total_hours" => $request->data['total_hours'],
                    "ot_hours" => $request->data['ot_hours'],
                    "late_hours" => $request->data['late_hours'],
                    "undertime" => $request->data['undertime'],
                    "type" => $type
                );
                TimeLogs::where('date', $date)->where('employee_id', $employee_id)->update($data);
            }
        }

        return $data;
    }

    public function get_record(Request $request, $id) {
        $record = EmployeeInformation::with('compensations','employments_tab', 'employments_tab.calendar')->where('id', $id)->first();
        $semi_monthly = $this->getSemiMonthly($record->employments_tab->calendar->start_date, $record->employments_tab->calendar->end_date, $request->date, $id);

        return response()->json(compact('record', 'semi_monthly'));
    }

    public function getSemiMonthly($startDate, $endDate, $date, $id) {
        
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        $selected = new DateTime($date);
        
        $start_2 = new DateTime($selected->format('Y').'-'.$selected->format('m').'-'.$start->format('d'));
        $end_2 = new DateTime($selected->format('Y').'-'.$selected->format('m').'-'.$end->format('d'));
        

        $output = [];

        $new_dates = [
            'first_half' => [
                "start" => $selected->format('Y').'-'.$selected->format('m').'-'.$start->format('d'),
                "end" => $selected->format('Y').'-'.$selected->format('m').'-'.$end->format('d')
            ],
            'second_half' => [
                "start" => $end_2->modify('+1 day')->format('Y-m-d'),
                "end" => $start_2->modify('+1 month')->modify('-1 day')->format('Y-m-d')
            ],
            'date' => $selected->format('Y-m-d')
        ];

        if($selected <= new DateTime($new_dates['first_half']['end'])) {
            $output = $this->generateOutput('first_half', $new_dates, $id);
        }
        else {
            $output = $this->generateOutput('second_half', $new_dates, $id);
        }

        return $output;
    }

    public function generateOutput($half, $dates, $id) {
        $output = [];
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod(new DateTime($dates[$half]['start']), $interval, (new DateTime($dates['second_half']['end']))->modify('+1 day'));
        
        foreach($period as $dt) {
            $employee = Timelogs::where('employee_id', $id)->where('date', $dt->format('Y-m-d'))->first();
            
            array_push($output, [
                "date" => $dt->format('Y-m-d'),
                "day" => $dt->format('l'),
                "time_in" => $employee !== null ? $employee->time_in:null,
                "break_in" => $employee !== null ? $employee->break_in:null,
                "break_out" => $employee !== null ? $employee->break_out:null,
                "time_out" => $employee !== null ? $employee->time_out:null,
                "ot_in" => $employee !== null ? $employee->ot_in:null,
                "ot_out" => $employee !== null ? $employee->ot_out:null,
            ]);
        }

        return $output;
    }
}
