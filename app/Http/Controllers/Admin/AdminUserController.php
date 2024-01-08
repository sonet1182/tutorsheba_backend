<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use File;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function admin(){
        return view('admin.layout.adminUser.addAdmin');
    }
    public function adminAdd(Request $request){
        $this->validate($request, [
            'secretCode' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'con_password' => 'required_with:password|same:password|min:6'
        ]);
        $code = 'Ak_nanno04';
        if ($code == $request->secretCode){
           $admin = new Admin();
           $admin->name = $request->name;
           $admin->email = $request->email;
           $admin->password = Hash::make($request->password);
           $admin->save();
           return back()->with('adminUser','successfully Save');
        }else{
            return back()->with('adminUser','You are Not Real Owner');
        }

    }
    public function adminList(){
        $admin = Admin::all();
        return view('admin.layout.adminUser.allAdmin',compact('admin'));
    }
    public function adminDelete($id)
    {
     Admin::destroy($id);
     return back()->with('message','Admin id deleted');
    }

    public function tutorlist(){
        $allUser = User::orderBy('id', 'desc')->get();
        return view('admin.layout.all_user',compact('allUser'));
    }

    public function tutorDelete($id)
    {
        if (request()->ajax()) {
            try {
                $user = User::find($id);
                if(isset($user))
                {
                    $user->delete();
                }
                $profile = TeacherProfile::where('user_id',$id)->first();
                if(isset($profile))
                {
                    $profile->delete();
                }
                $output = ['msg' => 'User delate successfully'];
            } catch (\Exception $e) {
                $output = ['msg' => 'Something went wrong / User alraddy deleted - reload this page'];
            }
            return $output;
        }
        return back()->with('message','Nothing Happend');
    }
}
