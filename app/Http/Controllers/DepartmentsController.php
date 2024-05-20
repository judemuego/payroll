<?php

namespace App\Http\Controllers;

use App\Departments;
use Auth;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    
    public function index()
    {
        $departments = Departments::orderBy('id', 'desc')->get();
        return view('backend.pages.payroll.maintenance.department', compact('departments'));
    }

    public function get() {
        if(request()->ajax()) {
            return datatables()->of(Departments::get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function store(Request $request)
    {
        $department = $request->validate([
            'description' => ['required'],
        ]);
        
        $request['workstation_id'] = Auth::user()->workstation_id;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        Departments::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $departments = Departments::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('departments'));
    }

    public function update(Request $request, $id)
    {
        $request['updated_by'] = Auth::user()->id;
        Departments::find($id)->update($request->all());
        return "Record Saved";
    }
    
    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            Departments::find($item)->delete();
        }
        
        return 'Record Deleted';
    }
}
