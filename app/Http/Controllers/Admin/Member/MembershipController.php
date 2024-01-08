<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Models\TeacherProfile;
use App\Models\User;
use App\Models\UserMembership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
      $member = UserMembership::with('user')->orderBy('id', 'DESC')
          ->paginate(12);
      return view('admin.layout.member.index',compact('member'));
    }

    public function create($id){
      $tutor = TeacherProfile::where('id',$id)->first();
      return view('admin.layout.member.create',compact('tutor'));
    }

    public function store(Request $request){
       $user = UserMembership::where('user_id',$request->user_id)->where('tutor_id',$request->tutor_id)->first();

       if ($user == null){
           if ($request->plan_id == 3){
               UserMembership::create([
                   'plan_id'=> $request->plan_id,
                   'amount'=> $request->amount,
                   'home_approval' => $request->home_approval,
                   'user_id'=> $request->user_id,
                   'tutor_id'=> $request->tutor_id,
                   'expire_date'=> date('Y-m-d H:i:s', strtotime("+183 days")),
               ]);
           }
           elseif ($request->plan_id == 2){
               UserMembership::create([
                   'plan_id'=> $request->plan_id,
                   'amount'=> $request->amount,
                   'home_approval' => $request->home_approval,
                   'user_id'=> $request->user_id,
                   'tutor_id'=> $request->tutor_id,
                   'expire_date'=> date('Y-m-d H:i:s', strtotime("+92 days")),
               ]);
           }else{
               UserMembership::create([
                   'plan_id'=> $request->plan_id,
                   'amount'=> $request->amount,
                   'home_approval' => $request->home_approval,
                   'user_id'=> $request->user_id,
                   'tutor_id'=> $request->tutor_id,
                   'expire_date'=> date('Y-m-d H:i:s', strtotime("+30 days")),
               ]);
           }
       }  else{
          return back()->with('message','this tutor already premium member');
       }

        $home = TeacherProfile::with('user','member')->where('id',$request->tutor_id)->first();
            $home->update([
            'home_approval' => 1,
            'approval' => 1
            ]);

//       if ($home){
//          onnorokom_sms([
//              'message' => "Dear, ".$home->user->name." you have purchased at plan ".$home->member->plan_id. " at BDT ".$home->member->amount.". Validity: ".date("d/m/Y", strtotime($home->member->expire_date)).". For details check mail & spam folder as well. http://deshtutor.com",
//              'mobile_number' => $home->user->phoneNumber
//              ]);
//
//          Mail::to($home->user->email)->send(new MembershipApprove($home));
//       }


        return redirect()->back()->with('message','This tutor account premium membersip');
    }

    public function edit($id){
      $tutor = UserMembership::where('id',$id)->first();
      return view('admin.layout.member.edit',compact('tutor'));
    }

    public function update(Request $request, $id){

        $input = $request->only(['plan_id', 'amount', 'home_approval']);

        $user = UserMembership::where('id', $id)->first();

        $user->plan_id = $input['plan_id'];
        $user->amount = $input['amount'];
        $user->home_approval = $input['home_approval'];

        if ($request->plan_id == 3){
          $user->expire_date = date('Y-m-d H:i:s', strtotime("+183 days"));
        } elseif ($request->plan_id == 2){
          $user->expire_date = date('Y-m-d H:i:s', strtotime("+92 days"));
        } else {
          $user->expire_date = date('Y-m-d H:i:s', strtotime("+30 days"));
        }

        $user->save();

//       if ($home){
//          onnorokom_sms([
//              'message' => "Dear, ".$home->user->name." you have purchased at plan ".$home->member->plan_id. " at BDT ".$home->member->amount.". Validity: ".date("d/m/Y", strtotime($home->member->expire_date)).". For details check mail & spam folder as well. http://deshtutor.com",
//              'mobile_number' => $home->user->phoneNumber
//              ]);
//
//          Mail::to($home->user->email)->send(new MembershipApprove($home));
//       }


        return redirect()->back()->with('message','This tutor account premium membersip update');
    }


    public function delete($id){
        UserMembership::destroy($id);
        return back()->with('message','Membership deleted');
    }

    public function sms(){
        $user = User::orderBy('id', 'DESC')->get();
        return view('admin.layout.sms.send',compact('user'));
    }

}
