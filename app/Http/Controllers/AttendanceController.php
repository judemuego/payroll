<?php

namespace App\Http\Controllers;

use App\EmployeeInformation;
use App\TimeLogs;
use App\ImageUpload;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function get() {
        if(request()->ajax()) {
            return datatables()->of(TimeLogs::with('employee', 'image')->where('date', date('Y-m-d'))->orderBy('date','asc')->get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function get_employee($rfid) {
        $record = EmployeeInformation::where('rfid', $rfid)->where('status', 1)->first();

        return response()->json(compact('record'));
    }
    
    public function store(Request $request)
    {
        $data = array(
            'employee_id' => $request->employee_id,
            'date' => date('Y-m-d'),
            'time_in' => $request->type === "time_in"?date('Y-m-d H:i:s'):null,
            'break_out' => $request->type === "break_out"?date('Y-m-d H:i:s'):null,
            'break_in' => $request->type === "break_in"?date('Y-m-d H:i:s'):null,
            'time_out' => $request->type === "time_out"?date('Y-m-d H:i:s'):null,
            'total_hours' => 0,
            'break_hours' => 0,
            'ot_hours' => 0,
            'late_hours' => 0,
            'undertime' => 0,
            'type' => 1,
            'workstation_id' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 1
        );

        // $get = TimeLogs::where('employee_id', $request->employee_id)->where('date', date('Y-m-d'))->whereNull($request->type)->get();

        if(TimeLogs::where('employee_id', $request->employee_id)->where('date', date('Y-m-d'))->count() !== 0) {
            if(TimeLogs::where('employee_id', $request->employee_id)->where('date', date('Y-m-d'))->whereNull($request->type)->count() !== 0) {
                TimeLogs::where('employee_id', $request->employee_id)->where('date', date('Y-m-d'))->update([$request->type => date('Y-m-d H:i:s')]);
                $attendance = TimeLogs::where('employee_id', $request->employee_id)->where('date', date('Y-m-d'))->firstOrFail();

                $file = $request->picture;  // your base64 encoded
                $explode = explode(",", $file);
                $ext = explode(";", $explode[0]);
                $ext = explode("/", $ext[0]);

                // $file = str_replace('data:image/png;base64,', '', $file);
                $file = str_replace(' ', '+', $explode[1]);
                $fileName = str_random(10).'_'.$attendance->id.'.'.$ext[1];
                \File::put(storage_path(). '/app/public/attendance/' . $fileName, base64_decode($file));

                try {
                    $data_access = array(
                        "attendance_id" => $attendance->id,
                        "type" => $request->type,
                        "filename" => $fileName,
                        "status" => 1
                    );
    
                    ImageUpload::create($data_access);
                } catch(Exception $e) {

                }

                $message = 'Saved';
            }
            else {
                $message = 'Already exist';
            }
        }
        else {
            $get = TimeLogs::where('employee_id', $request->employee_id)->orderBy('id','desc')->first();

            if($request->type === 'timeout') {
                $attendance = TimeLogs::where('date', $get->date)->update(['time_out'=>date('Y-m-d H:i:s')]);
                $text = $get->id;
            }
            else {
                $attendance = TimeLogs::create($data);
                $text = $attendance->id;
            }

            $file = $request->picture;  // your base64 encoded
            $explode = explode(",", $file);
            $ext = explode(";", $explode[0]);
            $ext = explode("/", $ext[0]);

            // $file = str_replace('data:image/png;base64,', '', $file);
            $file = str_replace(' ', '+', $explode[1]);
            $fileName = str_random(10).'_'.$text.'.'.$ext[1];
            \File::put(storage_path(). '/app/public/attendance/' . $fileName, base64_decode($file));

            $data_access = array(
                "attendance_id" => $text,
                "type" => $request->type,
                "filename" => $fileName,
                "status" => 1
            );

            ImageUpload::create($data_access);
            $message = 'Saved';
        }


        return response()->json(compact('data', 'message', 'get'));
    }
}
