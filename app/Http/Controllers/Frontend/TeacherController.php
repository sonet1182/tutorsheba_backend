<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AllDistrict;
use App\Models\AllMedium;
use App\Models\AnyClass;
use App\Models\AnySubject;
use App\Models\salaryRange;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Models\User;
use App\Models\UserMembership;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function details($id){
        $details = TeacherProfile::with('user','districts')
            ->where('teacher_id',$id)
            ->first();

        $primioum_tutor_check = UserMembership::where('tutor_id',$details->id)->first();

        $teacher = User::find($details->user_id);
        $teacher->views = $teacher->views + 1;
        $teacher->update();


        return view('frontend.pages.tutor_details',
            compact('details','teacher', 'primioum_tutor_check')
        );
    }

    public function request()
    {
        $districtList = AllDistrict::all();
        $medium = AllMedium::all();
        $class = AnyClass::all();
        $subject = AnySubject::orderBy('subjectName','asc')->get();
        $salary = salaryRange::all();
        return view('frontend.pages.request_for_tutor',[
            'districts'=>$districtList,
            'medium'=>$medium,
            'class'=>$class,
            'subject'=>$subject,
            'salary'=> $salary
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            's_fullName'=> 'required',
            's_phoneNumber'=> 'required|regex:/(01)[0-9]{9}/',
            's_districts' => 'required',
            's_area' => 'required',
            't_subject' => 'required',
        ]);
        $t_subject = implode(", ",$request->t_subject);

      $student = new StudentProfile();
      $student->title = $request->title;
      $student->s_fullName = $request->s_fullName;
      $student->s_phoneNumber = $request->s_phoneNumber;
      $student->s_email = $request->s_email;
      $student->s_gender = $request->s_gender;
      $student->s_college = $request->s_college;
      $student->s_class = $request->s_class;
      $student->s_medium = $request->s_medium;
      $student->s_districts = $request->s_districts;
      $student->s_area = $request->s_area;
      $student->s_address = $request->s_address;
      $student->t_gender = $request->t_gender;
      $student->t_subject = $t_subject;
      $student->t_days = $request->t_days;
      $student->t_salary = $request->t_salary;
      $student->ex_information = $request->ex_information;
      $student->save();
      return back()->with('message','Thank yor for requesting | your request successfully saved,');
    }
}
