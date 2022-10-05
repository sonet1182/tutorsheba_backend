<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\AssignedTeacher;
use App\Models\confirmedTeacher;
use App\Models\Notice;
use App\Models\rejectedTeacher;
use App\Models\TeacherProfile;
use App\Models\TuitionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){

        $teacher = TeacherProfile::with('user','districts')->where('user_id',Auth::user()->id)->first();
        $notice = Notice::where('id',1)->first();

        $applied = TuitionRequest::where('user_id', Auth::user()->id)->count();
        $assigned = AssignedTeacher::where('teacher_id', Auth::user()->id)->count();
        $confirmed = confirmedTeacher::where('teacher_id', Auth::user()->id)->count();
        $cancelled = rejectedTeacher::where('teacher_id', Auth::user()->id)->count();

        return view('tutor.pages.dashboard',compact('teacher','notice','applied','assigned','confirmed','cancelled'));
    }
}
