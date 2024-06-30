<?php

namespace App\Http\Controllers;

use App\Benefits;
use App\ChartOfAccount;
use Auth;
use Illuminate\Http\Request;

class BenefitsController extends Controller
{
    public function index()
    {
        $benefits = Benefits::orderBy('id', 'desc')->get();
        $record = ChartOfAccount::orderBy('id', 'desc')->get();
        return view('backend.pages.payroll.maintenance.benefits', compact('benefits', 'record'));
    }

    public function get() {
        if(request()->ajax()) {
            return datatables()->of(Benefits::with('chart')->orderBy('id', 'desc')->get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function store(Request $request)
    {
        $benefits = $request->validate([
            'benefits' => ['required'],
            'description' => ['required'],
            'chart_id' => ['required']
        ]);

        
        if (!Benefits::where('benefits', $validatedData['benefits'])->exists()) {
            
            $request['workstation_id'] = Auth::user()->workstation_id;
            $request['created_by'] = Auth::user()->id;
            $request['updated_by'] = Auth::user()->id;
        
            Benefits::create($request->all());
        }
        else { 
            return false;
           
        }
    }

    public function edit($id)
    {
        $benefits = Benefits::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('benefits'));
    }
    
    public function update(Request $request, $id)
    {
        Benefits::find($id)->update($request->all());
        return "Record Saved";
    }
    
    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            Benefits::find($item)->delete();
        }
        
        return 'Record Deleted';
    }

    public function governmentMandatedBenefits() 
    {
        $benefits = Benefits::where('type', 'government_mandated')->get();
        return response()->json(compact('benefits'));
    }

    public function otherCompanyBenefits() 
    {
        $benefits = Benefits::where('type', 'other')->get();
        return response()->json(compact('benefits'));
    }
}
