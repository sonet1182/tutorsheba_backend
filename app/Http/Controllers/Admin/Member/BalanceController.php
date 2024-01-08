<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
      $member = TeacherProfile::whereRaw('balance')->orderBy('id', 'DESC')
          ->paginate(12);
      return view('admin.layout.balance.index',compact('member'));
    }

    public function create($id){
      $tutor = TeacherProfile::where('id',$id)->first();
      return view('admin.layout.balance.create',compact('tutor'));
    }

    public function store(Request $request, $id){
       $user = TeacherProfile::where('id', $id)->first();

       if (!empty($user)){
          $user->update([
             'balance'=> !empty($request->balance) ? $request->balance : '0.00',
          ]);
        }

        return redirect()->back()->with('message','This Tutor successfully add balance amount of '. $request->balance);
    }

}
