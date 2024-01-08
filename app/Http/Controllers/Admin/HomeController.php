<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignedTeacher;
use App\Models\confirmedTeacher;
use App\Models\Manager;
use App\Models\Notice;
use App\Models\rejectedTeacher;
use App\Models\TextMessage;
use App\Models\TuitionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allUser()
    {
        $allUser = User::orderBy('id', 'desc')->get();
        return view('admin.layout.all_user',compact('allUser'));
    }

    public function userView($id)
    {
        $user=User::findOrFail($id);
        return view('admin.layout.user-edit',compact('user'));
    }

    public function userEdit(Request $request)
    {
        User::where('id', $request->id)->update([
            'approval'=> $request->approval,
            'verifyToken'=> null,
        ]);
        return back();
    }

    public function broadcast_notification()
    {
        $notice = Notice::find(1);
        return view('admin.layout.notification.broadcast')->with('notice', $notice);
    }

    public function broadcast_notification_post(Request $request)
    {
        $notice = Notice::find(1);

        $notice->title = $request->input('title');
        $notice->text = $request->input('text');
        $notice->user_id = 0;
        $notice->update();

        return back()->with('message','Notice Updated Successfully');
    }

    public function teacher_list()
    {
        $teacherProfile = DB::table('teacher_profile')
            ->join('users', 'teacher_profile.user_id', '=', 'users.id')
            ->join('all_districts', 'teacher_profile.district_id', '=', 'all_districts.id')
            ->select('teacher_profile.*','users.name', 'users.phoneNumber','users.email', 'all_districts.districtName')
            ->orderBy('id', 'DESC')
             ->paginate(3000);
        return view('admin.layout.notification.teacher_list',compact('teacherProfile'));
    }


    public function all_text()
    {
        $teacherProfile = DB::table('teacher_profile')
            ->join('users', 'teacher_profile.user_id', '=', 'users.id')
            ->join('all_districts', 'teacher_profile.district_id', '=', 'all_districts.id')
            ->select('teacher_profile.*','users.name', 'users.phoneNumber','users.email', 'all_districts.districtName')
            ->orderBy('id', 'DESC')
             ->paginate(3000);
        return view('admin.layout.notification.teacher_list',compact('teacherProfile'));
    }


    public function all_manager()
    {
        $managers = Manager::where('delete_status',0)->get();

        return view('admin.layout.all_manager',compact('managers'));
    }

    public function deleted_manager()
    {
        $deleted_managers = Manager::where('delete_status',1)->get();
        return view('admin.layout.deleted_manager',compact('deleted_managers'));
    }

    public function add_manager(Request $req)
    {
        $manager = new Manager();
        $manager->name = $req->name;
        $manager->email = $req->email;
        $manager->password = Hash::make($req->password);
        $manager->save();
        return back()->with('status','Manager Added Successfully');
    }

    public function edit_manager(Request $req, $id)
    {
        $manager = Manager::find($id);
        $manager->name = $req->name;
        $manager->email = $req->email;
        $manager->password = Hash::make($req->password);
        $manager->save();
        return back()->with('status','Manager Updated Successfully');
    }

    public function delete_manager($id)
    {
        $manager = Manager::find($id);
        $manager->delete_status = 1;
        $manager->save();

        return back()->with('status','Manager Updated Successfully');
    }

    public function enable_manager($id)
    {
        $manager = Manager::find($id);
        $manager->delete_status = 0;
        $manager->save();

        return back()->with('status','Manager Updated Successfully');
    }

    public function applyTuitionList($id){
        $studentinfo = TuitionRequest::with('student')->where('user_id', $id)->get();

        $status = 'Applied';

        return view('admin.layout.teacher.job_list',compact('studentinfo','status'));
    }

    public function assignedTuitionList($id){

        $studentinfo = AssignedTeacher::where('teacher_id', $id)->get();

        $status = 'Assigned';

        return view('admin.layout.teacher.job_list',compact('studentinfo','status'));
    }

    public function confirmedTuitionList($id){

        $studentinfo = confirmedTeacher::where('teacher_id', $id)->get();

        $status = 'Confirmed';

        return view('admin.layout.teacher.job_list',compact('studentinfo','status'));
    }

    public function cancelledTuitionList($id){

        $studentinfo = rejectedTeacher::where('teacher_id', $id)->with('student')->get();

        $status = 'Rejected';

        return view('admin.layout.teacher.job_list',compact('studentinfo','status'));
    }

    public function individual_notice()
    {
        $texts = TextMessage::latest()->paginate(30);
        return view('admin.layout.student.text_list', compact('texts'));
    }



}
