<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
       
        return view('backend.pages.setup.user');
    }

    public function get() {
        if(request()->ajax()) {
            return datatables()->of(User::get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function store(Request $request)
    {
        $department = $request->validate([
            'firstname' => ['required'],
            'middlename',
            'lastname' => ['required'],
            'suffix' => ['required'],
            'email' => ['required'],
            'profile_img' => ['required'],
            'status' => ['required'],
        ]);

        $request->request->add(['workstation_id' => Auth::user()->workstation_id, 'created_by' => Auth::user()->id, 'password' => '$2y$10$DcfXc7JdR58QvunoINadbe/8L.ur29S0fTxcyCH0PJPpUvBhrtmd.']);
        User::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $users = User::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request['status'] = isset($request['status'])?1:0;
        User::find($id)->update($request->all());
        return response()->json(['Successfully Updated']);
    }
    
    public function destroy($id)
    {
        $deparment_destroy = User::find($id);
        $deparment_destroy->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }

}
