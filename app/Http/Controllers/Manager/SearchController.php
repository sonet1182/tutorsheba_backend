<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\AllArea;
use App\Models\AllDistrict;
use App\Models\AllMedium;
use App\Models\AnyClass;
use App\Models\AnySubject;
use App\Models\AssignedTeacher;
use App\Models\confirmedTeacher;
use App\Models\rejectedTeacher;
use App\Models\TeacherProfile;
use App\Models\TuitionRequest;
use Illuminate\Http\Request;

class SearchController extends Controller
{
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

        return view('manager.pages.teacher.teacher_details',compact('teacherDetails','applied','assigned','confirmed','cancelled'));
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

        return view('manager.pages.teacher.teacher_details',compact('teacherDetails','applied','assigned','confirmed','cancelled'));
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

        return view('manager.pages.teacher.teacher_details',compact('teacherDetails','applied','assigned','confirmed','cancelled'));
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

        return view('manager.pages.teacher.teacher_details',compact('teacherDetails','applied','assigned','confirmed','cancelled'));
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

        return view('manager.pages.teacher.teacher_details',compact('teacherDetails','applied','assigned','confirmed','cancelled'));
        } else {
            return redirect(url()->previous() . '#alart2')->with('AlertErrorMessage2', 'Email Address not found.');
        }
    }

    public function searchResult2(Request $request)
    {
        $districts = $request->get('districts');
        $tuition_area = $request->get('area');
        $tuition_medium = $request->get('medium');
        $tuition_class = $request->get('class');
        $tuition_subject = $request->get('subject');
        $teacher_gender = $request->get('gender');
        $teacher_university = $request->get('university');
        $teacher_subject = $request->get('t_subject');
        $perPage = 8;


        $search = TeacherProfile::with('user')
            ->where('district_id', 'LIKE', $districts)
            ->where('tuition_area', 'LIKE', "%$tuition_area%")
            ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
            ->Where('tuition_class', 'LIKE', "%$tuition_class%")
            ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
            ->Where('teacher_gender', 'LIKE', $teacher_gender)
            ->Where('honours_institute', 'LIKE', "%$teacher_university%")
            ->Where('honours_subject', 'LIKE', "%$teacher_subject%")
            ->latest()
            ->paginate(50);


        $allDistrict = AllDistrict::all();
        $allArea = AllArea::all();
        $allMedium = AllMedium::all();
        $anyClass = AnyClass::all();
        $anySubject = AnySubject::orderBy('subjectName', 'asc')->get();
        // $salaryRange = salaryRange::all();


        return view('manager.pages.teacher.search-result', [
            'teacherProfile' => $search,
            'allDistrict' => $allDistrict,
            'allArea' => $allArea,
            'allMedium' => $allMedium,
            'anyClass' => $anyClass,
            'anySubject' => $anySubject,
            'districts' => $districts,
            'tuition_area' => $tuition_area,
            'tuition_medium' => $tuition_medium,
            'tuition_class' => $tuition_class,
            'tuition_subject' => $tuition_subject,
            'teacher_gender' => $teacher_gender
        ]);
    }


    public function searchResultByEdu(Request $request)
    {
        // return $request->all();

        $instiTypes = $request->get('instiTypes');
        $institute = $request->get('institute');
        $studyTypes = $request->get('studyTypes');
        $departments = $request->get('departments');
        $curciculam = $request->get('curciculam');

        $search = TeacherProfile::with('user')
            ->where(function ($query) use ($instiTypes, $studyTypes) {
                if ($instiTypes) {
                    $query->orWhere('honours_insti_type', $instiTypes);
                }
                if ($studyTypes) {
                    $query->orWhere('honours_insti_type', $studyTypes);
                }
            })
            ->where(function ($query) use ($institute) {
                if ($institute) {
                    $query->orWhere('honours_institute', 'LIKE', "%$institute%");
                }
            })
            ->where(function ($query) use ($departments) {
                if ($departments) {
                    $query->orWhere('honours_subject', 'LIKE', "%$departments%");
                }
            })
            ->where(function ($query) use ($curciculam) {
                if ($curciculam) {
                    $query->orWhere('honours_curriculam', 'LIKE', "%$curciculam%");
                }
            })
            ->latest()
            ->paginate(50);

        return view('manager.pages.teacher.search-result', [
            'teacherProfile' => $search,
        ]);
    }
}
