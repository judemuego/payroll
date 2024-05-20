<?php

namespace App\Http\Controllers;

use Auth;
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
}
