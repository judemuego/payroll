<?php

namespace App\Http\Controllers;

use Auth;
use App\Deductions;
use App\ChartOfAccount;
use Illuminate\Http\Request;

class DeductionsController extends Controller
{
    
    public function index()
    {
        $record = ChartOfAccount::orderBy('id', 'desc')->get();
        return view('backend.pages.setup.payroll_setup.deductions', compact('record'));
    }
    
    public function get() {
        if(request()->ajax()) {
            return datatables()->of(Deductions::with('chart')->get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:deductions',
            'type' => 'required',
            'chart_id' => 'required',
            'status' => 'required',
        ]);
        
        $request['workstation_id'] = Auth::user()->workstation_id;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        Deductions::create($request->all());

        return response()->json(compact('validate'));
    }
    
    public function edit($id)
    {
        $deductions = Deductions::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('deductions'));
    }

    public function update(Request $request, $id)
    {
        $request['updated_by'] = Auth::user()->id;
        Deductions::find($id)->update($request->all());
        return "Record Saved";
    }

    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            Deductions::find($item)->delete();
        }
        
        return 'Record Deleted';
    }
}
