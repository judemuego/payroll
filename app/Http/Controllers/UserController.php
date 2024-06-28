<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
    public function index()
    {
       
        return view('backend.pages.setup.user');
    }

    public function get() {
        if(request()->ajax()) {
            return datatables()->of(User::orderBy('id', 'desc')->get())
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
    
    public function changepass(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(Auth::user()->id)->update(['password'=> Hash::make($request->new_password)]);

        Auth::logout();
        return redirect('/login')->with('success','Successfully Updated');
    }

    public function changePicture(Request $request)
    {
        $request->validate([
            'picture' => 'required',
        ]);
        $file = $request->picture->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $subfolder = 'profile';

        $imageName = $filename.time().'.'.$request->picture->extension();  
        $picture = $request->picture->move(public_path('images/profile'), $imageName);
        
        // $this->spacesService->upload($request->picture, $subfolder, $imageName);

        $requestData = $request->all();
        $requestData['picture'] = $imageName;

        User::find($request->user_id)->update(['profile_img'=> $imageName]);
        
        return redirect()->back()->with('success','Successfully Updated');
    }

}
