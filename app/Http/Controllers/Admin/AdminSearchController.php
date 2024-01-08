<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignedTeacher;
use App\Models\confirmedTeacher;
use App\Models\rejectedTeacher;
use App\Models\TeacherProfile;
use App\Models\TuitionRequest;
use Illuminate\Http\Request;

class AdminSearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function searchName(Request $request){
        $teacherDetails = TeacherProfile::with('user','districts')
            ->whereHas("user", function($user) use($request) {
                $user->where('name', 'LIKE', "%$request->name%");
            })->paginate(20);
        if (!$teacherDetails->isEmpty()) {
            $applied = TuitionRequest::where('user_id', $teacherDetails->user_id)->count();
        $assigned = AssignedTeacher::where('teacher_id', $teacherDetails->user_id)->count();
        $confirmed = confirmedTeacher::where('teacher_id', $teacherDetails->user_id)->count();
        $cancelled = rejectedTeacher::where('teacher_id', $teacherDetails->user_id)->count();

        return view('admin.layout.teacher.teacher_details',compact('teacherDetails','applied','assigned','confirmed','cancelled'));
        } else {
            return redirect(url()->previous() . '#alart')->with('AlertErrorMessage', 'Tutor Name not found.');
        }
    }

    public function searchInstitution(Request $request){
        $teacherDetails = TeacherProfile::with('user','districts')
            ->where('honours_institute',  'LIKE', "%$request->name%")
           ->paginate(20);

        if (!$teacherDetails->isEmpty()) {
            $applied = TuitionRequest::where('user_id', $teacherDetails->user_id)->count();
        $assigned = AssignedTeacher::where('teacher_id', $teacherDetails->user_id)->count();
        $confirmed = confirmedTeacher::where('teacher_id', $teacherDetails->user_id)->count();
        $cancelled = rejectedTeacher::where('teacher_id', $teacherDetails->user_id)->count();

        return view('admin.layout.teacher.teacher_details',compact('teacherDetails','applied','assigned','confirmed','cancelled'));
        } else {
            return redirect(url()->previous() . '#alart')->with('AlertErrorMessage', 'Institution not found.');
        }
    }

    public function searchId(Request $request){
        $teacherDetails = TeacherProfile::with('user','districts')->where('teacher_id', '=', $request->id)->first();
        if ($teacherDetails) {
            $applied = TuitionRequest::where('user_id', $teacherDetails->user_id)->count();
        $assigned = AssignedTeacher::where('teacher_id', $teacherDetails->user_id)->count();
        $confirmed = confirmedTeacher::where('teacher_id', $teacherDetails->user_id)->count();
        $cancelled = rejectedTeacher::where('teacher_id', $teacherDetails->user_id)->count();

        return view('admin.layout.teacher.teacher_details',compact('teacherDetails','applied','assigned','confirmed','cancelled'));
        } else {
            return redirect(url()->previous() . '#alart1')->with('AlertErrorMessage1', 'Teacher ID not found.');
        }
    }

    public function searchPhoneNumber(Request $request){
        $teacherDetails = TeacherProfile::with('user','districts')
            ->whereHas("user", function($user) use($request) {
                $user->where("phoneNumber", $request->phoneNumber);
            })->first();
        if ($teacherDetails) {

        $applied = TuitionRequest::where('user_id', $teacherDetails->user_id)->count();
        $assigned = AssignedTeacher::where('teacher_id', $teacherDetails->user_id)->count();
        $confirmed = confirmedTeacher::where('teacher_id', $teacherDetails->user_id)->count();
        $cancelled = rejectedTeacher::where('teacher_id', $teacherDetails->user_id)->count();

        return view('admin.layout.teacher.teacher_details',compact('teacherDetails','applied','assigned','confirmed','cancelled'));
        } else {
            return redirect(url()->previous() . '#alart1')->with('AlertErrorMessage1', 'Phone Number not found.');
        }
    }

    public function searchEmailAddress(Request $request){
        $teacherDetails = TeacherProfile::with('user','districts')
            ->whereHas("user", function($user) use($request) {
                $user->where("email", $request->email);
            })->first();
        if ($teacherDetails) {
            $applied = TuitionRequest::where('user_id', $teacherDetails->user_id)->count();
        $assigned = AssignedTeacher::where('teacher_id', $teacherDetails->user_id)->count();
        $confirmed = confirmedTeacher::where('teacher_id', $teacherDetails->user_id)->count();
        $cancelled = rejectedTeacher::where('teacher_id', $teacherDetails->user_id)->count();

        return view('admin.layout.teacher.teacher_details',compact('teacherDetails','applied','assigned','confirmed','cancelled'));
        } else {
            return redirect(url()->previous() . '#alart2')->with('AlertErrorMessage2', 'Email Address not found.');
        }
    }
}
