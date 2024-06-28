<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Auth;

class PermissionController extends Controller
{
    public function index()
    {
        return view('backend.pages.setup.permission');
    }

    public function get() {
        if(request()->ajax()) {
            return datatables()->of(Permission::get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function store(Request $request)
    {
        $department = $request->validate([
            'name' => ['required'],
        ]);

        $request->request->add(['guard_name' => 'web', 'created_by' => Auth::user()->id]);
        Permission::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $roles = Permission::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('roles'));
    }

    public function update(Request $request, $id)
    {
        $request['status'] = isset($request['status'])?1:0;
        Permission::find($id)->update($request->all());
        return response()->json(['Successfully Updated']);
    }
    
    public function destroy($id)
    {
        $deparment_destroy = Permission::find($id);
        $deparment_destroy->delete();
        return response()->json(['Successfully Deleted!']);
    }
}
