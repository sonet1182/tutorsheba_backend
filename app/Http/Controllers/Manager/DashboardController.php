<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\AllArea;
use App\Models\AllDistrict;
use App\Models\AllMedium;
use App\Models\AnyClass;
use App\Models\AnySubject;
use App\Models\Institype;
use App\Models\Partner;
use App\Models\RequestTeacher;
use App\Models\StudentProfile;
use App\Models\Studytype;
use App\Models\TeacherProfile;
use App\Models\TuitionRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $allDistrict = AllDistrict::all();
        $allArea = AllArea::all();
        $allMedium = AllMedium::all();
        $anyClass = AnyClass::all();
        $anySubject = AnySubject::orderBy('subjectName','asc')->get();
        $tutor = TeacherProfile::count();
        $student = StudentProfile::count();
        $uddokta = Partner::count();
        $studentRequest = RequestTeacher::count();
        $tutorRequest = TuitionRequest::count();

        $instiTypes = Institype::orderBy('name', 'ASC')->get();
        $universities = Institype::orderBy('name', 'ASC')->get();
        $studyTypes = Studytype::orderBy('name', 'ASC')->get();


        $approval_studentProfile = StudentProfile::where('student_profile.approval' ,'=', 1)
            ->orWhere('student_profile.approval' ,'=', 4)
            ->orWhere('student_profile.approval' ,'=', 5)->count();

       return view('manager.pages.dashboard',
           [
           'tutor'=> $tutor,
           'student'=> $student,
           'uddokta'=> $uddokta,
           'tutorRequest'=> $tutorRequest,
           'approval_studentProfile' => $approval_studentProfile,
           'instiTypes' => $instiTypes,
           'universities' => $universities,
           'studyTypes' => $studyTypes,
           'studentRequest'=> $studentRequest,
            'allDistrict'=>$allDistrict,
               'allArea'=>$allArea,
               'allMedium'=>$allMedium,
               'anyClass'=>$anyClass,
               'anySubject'=>$anySubject,
           ]);
    }
}
