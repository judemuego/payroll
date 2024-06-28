<?php

namespace App\Http\Controllers;

use App\Traits\GlobalFunction;
use App\EmployeeInformation;
use App\CompanyworkCalendar;
use App\PayrollCalendar;
use App\WorkCalendar;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Classes;
use App\Departments;
use App\Positions;
use App\LeaveType;

class EmployeeInformationController extends Controller
{
    use GlobalFunction;

    public function index()
    {
        $classes = Classes::get();
        $department = Departments::get();
        $position = Positions::get();
        $leave_type = LeaveType::get();
        $payroll_calendar = PayrollCalendar::get();
        return view('backend.pages.payroll.transaction.employee_information.index', compact('classes', 'position', 'department', 'leave_type', 'payroll_calendar'), ["type"=>"2-view"]);
    }

    public function store(Request $request)
    {
        
        $validate = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'birthdate' => 'required',
            'citizenship' => 'required',
            'phone1' => 'required',
            'street_1' => 'required',
            'barangay_1' => 'required',
            'city_1' => 'required',
            'province_1' => 'required',
            'country_1' => 'required',
            'zip_1' => 'required',
            'email' => 'required|unique:employees'
        ]);

        $existingEmployee = EmployeeInformation::where([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
        ])->first();

        if ($existingEmployee) {

            return false;
        }
        else {

            $request['employee_no'] = $this->series('EMP', 'EmployeeInformation');

        if($request->profile_img !== null) {
            $request['profile_img'] = $this->uploadFile($request->profile_img, 'images/payroll/employee-information/', date('Ymdhis'));
        }
        else {
            $request['profile_img'] = "default.png";
        }
 
        $request['workstation_id'] = Auth::user()->workstation_id;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        $employee = EmployeeInformation::create($request->all());
        $company_work_calendar = CompanyworkCalendar::where('workstation_id', Auth::user()->workstation_id)->firstOrFail();

        if($company_work_calendar != null) {
            $workcalendar = array(
                'employee_id' => $employee->id,
                'sunday_start_time' => $company_work_calendar->sunday_start_time,
                'sunday_end_time' => $company_work_calendar->sunday_end_time,
                'monday_start_time' => $company_work_calendar->monday_start_time,
                'monday_end_time' => $company_work_calendar->monday_end_time,
                'tuesday_start_time' => $company_work_calendar->tuesday_start_time,
                'tuesday_end_time' => $company_work_calendar->tuesday_end_time,
                'wednesday_start_time' => $company_work_calendar->wednesday_start_time,
                'wednesday_end_time' => $company_work_calendar->wednesday_end_time,
                'thursday_start_time' => $company_work_calendar->thursday_start_time,
                'thursday_end_time' => $company_work_calendar->thursday_end_time,
                'friday_start_time' => $company_work_calendar->friday_start_time,
                'friday_end_time' => $company_work_calendar->friday_end_time,
                'employee_id' => $employee->id,
                'workstation_id' => Auth::user()->workstation_id,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            );

            WorkCalendar::create($workcalendar);
        } 

        $last_record = array("id" => $employee->id, "employee_no" => $employee->employee_no);

        return response()->json(compact('validate', 'last_record'));

        }

        
    }

    public function get()
    {
        if(request()->ajax()) {
            return datatables()->of(EmployeeInformation::select("id", "employee_no", DB::raw("CONCAT(employees.firstname,' ',employees.lastname) as full_name"), "email")->orderBy('id', 'desc')->get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function getmasterlist()
    {
        if(request()->ajax()) {
            return datatables()->of(EmployeeInformation::with('employments_tab', 'leave_tab', 'works_calendar', 'compensations')->orderBy('id', 'desc')->get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function edit($id)
    {
        $employee = EmployeeInformation::with('employments_tab', 'works_calendar', 'compensations')->where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('employee'));
    }

    public function update(Request $request, $id)
    {
        
        $validate = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'firstname' => 'required',
            'gender' => 'required',
            'birthdate' => 'required',
            'citizenship' => 'required',
            'phone1' => 'required',
            'street_1' => 'required',
            'barangay_1' => 'required',
            'city_1' => 'required',
            'province_1' => 'required',
            'country_1' => 'required',
            'zip_1' => 'required',
            'email' => 'required'
        ]);

        if($request->profile_img !== null && $request->profile_img !== '') {
            $request['profile_img'] = $this->uploadFile($request->profile_img, 'images/payroll/employee-information/', date('Ymdhis'));
        }
        else {
            $request['profile_img'] = EmployeeInformation::where('id', $id)->first()->profile_img;
        }

        EmployeeInformation::findOrFail($id)->update($request->except('created_by'));
        return response()->json(compact('validate'));
    }

    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            EmployeeInformation::find($item)->delete();
        }
        
        return 'Record Deleted';
    }

    public function masterlist() {
        return view('backend.pages.masterlist.employee', ["type"=>"full-view"]);
    }
}
