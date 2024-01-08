<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\AssignedTeacher;
use App\Models\confirmedTeacher;
use App\Models\rejectedTeacher;
use App\Models\TeacherProfile;
use App\Models\TuitionRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TeacherRequestController extends Controller
{
    public function newTeacherRequest()
    {
        $total = User::where('approval', 0)->count();
        $teacherProfile = User::where('approval', 0)->latest()->paginate(21);

        return view('manager.pages.teacher.new_teacher_request', compact('teacherProfile', 'total'));
    }

    public function newTeacherRequest_approve_all()
    {
        User::where('approval', 0)->update(['approval' => 1]);
        return back()->with('success', 'Approved All Teachers Profile Successfully');
    }


    public function approvalTeacherList()
    {
        $total = User::where('approval', 1)->count();
        $teacherProfile = User::where('approval', 1)->orderBy('updated_at', 'DESC')->paginate(21);
        return view('manager.pages.teacher.approval_teacher_list', compact('teacherProfile', 'total'));
    }

    public function verifiedTeacherList()
    {
        $total = User::where('verified', 1)->count();
        $teacherProfile = User::with('teacher')->where('verified', 1)->orderBy('updated_at', 'DESC')->paginate(21);
        return view('manager.pages.teacher.verified_teacher_list', compact('teacherProfile', 'total'));
    }


    public function rejectedTeacherList()
    {
        $teacherProfile = DB::table('teacher_profile')
            ->join('users', 'teacher_profile.user_id', '=', 'users.id')
            ->join('all_districts', 'teacher_profile.district_id', '=', 'all_districts.id')
            ->select('teacher_profile.*', 'users.name', 'users.phoneNumber', 'users.email', 'all_districts.districtName')
            ->where('teacher_profile.approval', '=', 3)
            ->orderBy('id', 'DESC')
            ->get();
        return view('manager.pages.teacher.rejected_teacher_list', compact('teacherProfile'));
    }


    public function teacherDetails($id)
    {
        $teacherDetails = TeacherProfile::with('user', 'districts')->where('user_id', '=', $id)->first();

        if ($teacherDetails) {
            $applied = TuitionRequest::where('user_id', $id)->count();
            $assigned = AssignedTeacher::where('teacher_id', $id)->count();
            $confirmed = confirmedTeacher::where('teacher_id', $id)->count();
            $cancelled = rejectedTeacher::where('teacher_id', $id)->count();
            return view('manager.pages.teacher.teacher_details', compact('teacherDetails', 'applied', 'assigned', 'confirmed', 'cancelled'));
        } else {
            $teacherProfile = new TeacherProfile();
            $teacherProfile->user_id = $id;
            $teacherProfile->teacher_profile_picture = 'img/icon/user.png';
            $teacherProfile->teacher_id = 'TS-' . $id;
            $teacherProfile->save();

            $teacherDetails = TeacherProfile::with('user', 'districts')->where('user_id', '=', $id)->first();
            $applied = TuitionRequest::where('user_id', $id)->count();
            $assigned = AssignedTeacher::where('teacher_id', $id)->count();
            $confirmed = confirmedTeacher::where('teacher_id', $id)->count();
            $cancelled = rejectedTeacher::where('teacher_id', $id)->count();

            return view('manager.pages.teacher.teacher_details', compact('teacherDetails', 'applied', 'assigned', 'confirmed', 'cancelled'));
        }
    }
    public function homeApprovalTeacherList()
    {
        $teacherProfile = TeacherProfile::with('user', 'districts')
            ->whereHas('user', function ($q) {
                $q->where('approval', '=', 1);
            })
            ->where("home_approval", 1)
            ->latest()
            ->paginate(21);

        return view('manager.pages.teacher.home-approval', compact('teacherProfile'));
    }

    public function teacherApproval($id)
    {
        $tutor = User::where('id', $id)->first();
        $tutor->approval = 1;
        $tutor->save();
        return back()->with('message', 'This Teacher Account Approved');
    }

    public function teacherVerify($id)
    {
        $tutor = User::where('id', $id)->first();

        $tutor->approval = 1;
        $tutor->verified = 1;
        $tutor->save();

        return back()->with('message', 'This Teacher Account has Verified');
    }

    public function teacherPremium($id)
    {
        $profile = TeacherProfile::where('user_id', $id)->first();
        $profile->home_approval = 1;
        $profile->save();

        return back()->with('message', 'This Teacher Account has Set as Premium');
    }


    public function teacherRejected($id)
    {
        $tuition = TeacherProfile::find($id);
        $tuition->approval = 3;
        $tuition->home_approval = 0;
        $tuition->save();
        return back()->with('message', 'This Tuition Account Rejected');
    }
}
