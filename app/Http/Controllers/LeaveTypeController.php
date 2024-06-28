<?php

namespace App\Http\Controllers;

use Auth;
use App\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    
    public function index()
    {
        $leaveType = LeaveType::orderBy('id', 'desc')->get();
        return view('backend.pages.payroll.maintenance.leave_type', compact('leaveType'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'leave_name' => 'required|unique:leave_types'
        ]);

        $request['workstation_id'] = Auth::user()->workstation_id;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        LeaveType::create($request->all());

        return response()->json(compact('validate'));
    }

    public function get() {
        if(request()->ajax()) {
            return datatables()->of(LeaveType::get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function edit($id)
    {
        $leaveType = LeaveType::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('leaveType'));
    }

    public function update(Request $request, $id)
    {
        $request['updated_by'] = Auth::user()->id;
        LeaveType::find($id)->update($request->all());
        return "Record Saved";
    }

    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            LeaveType::find($item)->delete();
        }
        
        return 'Record Deleted';
    }

    public function getData() {
        $leaveType = LeaveType::orderBy('id')->get();
        return response()->json(compact('leaveType'));
    }
}
