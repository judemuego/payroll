<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Http\Request;
use Auth;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::orderBy('id', 'desc')->get();
        return view('backend.pages.purchasing.maintenance.site', compact('sites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => ['required'],
            'location' => ['required'],
            'person_in_charge' => ['required']
        ]);

        $request['workstation_id'] = Auth::user()->workstation_id;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        Site::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function get() {
        if(request()->ajax()) {
            return datatables()->of(Site::get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function edit($id)
    {
        $sites = Site::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('sites'));
    }

    public function update(Request $request, $id)
    {
        $request['tax_applicable'] = isset($request['tax_applicable'])?1:0;
        $request['government_mandated_benefits'] = isset($request['government_mandated_benefits'])?1:0;
        $request['other_company_benefits'] = isset($request['other_company_benefits'])?1:0;

        Site::find($id)->update($request->all());
        return "Record Saved";
    }

    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            Site::find($item)->delete();
        }

        return 'Record Deleted';
    }
}
