<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\TeacherProfile;
use App\Models\TuitionRequest;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllRequestController extends Controller
{
    public function studentTutorRequest()
    {
        $tutorRequest = DB::table('student_tutors_request')
            ->join('users', 'student_tutors_request.user_id', '=', 'users.id')
            ->select('student_tutors_request.*','users.name','users.email','users.phoneNumber')
            ->orderBy('student_tutors_request.id', 'DESC')
            ->paginate(10);
        return view('manager.pages.request.student_tutor_request',compact('tutorRequest'));
    }
      public function teacherTuitionRequest()
    {
        $tuitionRequest = TuitionRequest::with('teacher','student')
            ->orderBy('student_id', 'DESC')
            ->paginate(10);
        return view('manager.pages.request.teacher_tuition_request',compact('tuitionRequest'));
    }


    public function requestDetails($id)
    {
        $tuitionRequest = DB::table('teacher_tuition_request')->where('id',$id)->first();
        if ($tuitionRequest){
             $teacherInfo =DB::table('teacher_profile')->where('user_id',$tuitionRequest->user_id)->first();
             if (!empty($teacherInfo->district_id)){
                 $teacherDetails = TeacherProfile::with('user','districts')->where('id', '=', $teacherInfo->id)->first();
             }else{
                return back()->with('message','Teacher Profile Incomplete');
             }
             $studentinfo =DB::table('student_profile')->where('id',$tuitionRequest->student_id)->first();
             if ($studentinfo){
                 $studentDetails = DB::table('student_profile')
                     ->join('all_districts', 'student_profile.s_districts', '=', 'all_districts.id')
                     ->select('student_profile.*','all_districts.districtName')
                     ->where('student_profile.id' ,'=', $studentinfo->id)
                     ->first();
             }
        }
        return view('manager.pages.request.request-details',compact('teacherDetails','studentDetails','tuitionRequest'));
    }


    public function profile_verification_request()
    {
        $tutorRequest = Verification::where('profile_verification_request',1)->latest()->get();
        return view('manager.pages.request.profile_verification_request',compact('tutorRequest'));
    }
}
