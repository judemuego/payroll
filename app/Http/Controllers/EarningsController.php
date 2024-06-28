<?php

namespace App\Http\Controllers;

use Auth;
use App\Earnings;
use Illuminate\Http\Request;

class EarningsController extends Controller
{
    
    public function index()
    {
        return view('backend.pages.setup.payroll_setup.earnings');
    }
    
    public function get() {
        if(request()->ajax()) {
            return datatables()->of(Earnings::get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:earnings',
            'type' => 'required',
            'status' => 'required',
        ]);
        
        $request['workstation_id'] = Auth::user()->workstation_id;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        Earnings::create($request->all());

        return response()->json(compact('validate'));
    }
    
    public function edit($id)
    {
        $earning = Earnings::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('earning'));
    }

    public function update(Request $request, $id)
    {
        $request['updated_by'] = Auth::user()->id;
        Earnings::find($id)->update($request->all());
        return "Record Saved";
    }

    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            Earnings::find($item)->delete();
        }
        
        return 'Record Deleted';
    }
}
