<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\AllArea;
use App\Models\AllDistrict;
use App\Models\AllMedium;
use App\Models\AnyClass;
use App\Models\AnySubject;
use App\Models\Manager;
use App\Models\salaryRange;
use App\Models\StudentProfile;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function create(){
        $districtList = AllDistrict::all();
        $medium = AllMedium::all();
        $class = AnyClass::all();
        $subject = AnySubject::orderBy('subjectName','asc')->get();
        $salary = salaryRange::all();

        // return $salary;

        return view('manager.pages.tuition.create',[
            'districts'=>$districtList,
            'medium'=>$medium,
            'class'=>$class,
            'subject'=>$subject,
            'salary'=> $salary
        ]);
    }

    public function edit($id){
        $districtList = AllDistrict::all();
        $medium = AllMedium::all();
        $class = AnyClass::all();
        $subject = AnySubject::orderBy('subjectName','asc')->get();
        $salary = salaryRange::all();
        $tuition = StudentProfile::with('districts')->where('id',$id)->first();
        $s_medium = AllMedium::where('mediumName',$tuition->s_medium)->first();
        $classes = AnyClass::where('medium_id',$s_medium->id)->get();
        $areas = AllArea::where('district_id',$tuition->s_districts)->get();
        $managers = Manager::where('delete_status',0)->get();
        return view('manager.pages.tuition.edit',[
            'districts'=>$districtList,
            'medium'=>$medium,
            'class'=>$class,
            'subject'=>$subject,
            'salary'=> $salary,
            'tuition'=> $tuition,
            'managers'=>$managers,
            'areas'=>$areas,
            'classes'=>$classes,
        ]);
    }


    public function store(Request $request){
        $request->validate([
            's_fullName'=> 'required',
            's_phoneNumber'=> 'required|regex:/(01)[0-9]{9}/',
            's_districts' => 'required',
            's_area' => 'required',
            't_subject' => 'required',
        ]);

        $t_subject = implode(", ",$request->t_subject);

        $prev_student = StudentProfile::where('approval',1)->latest()->first();
        $prev_manager_id = $prev_student->manager;


        $manager_list = Manager::where('delete_status',0)->get();

        $manager_max_id = $manager_list->max('id');
        $manager_min_id = $manager_list->min('id');


        if($prev_manager_id < $manager_max_id)
        {
           $next_manager_id = $manager_list->where('id','>',$prev_manager_id)->where('delete_status',0)->first()->id;
        }else{
            $next_manager_id = $manager_min_id;
        }




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
        $student->time = $request->time;
        $student->t_salary = $request->t_salary;
        $student->ex_information = $request->ex_info;
        $student->s_number = $request->student_number;
        $student->tutoring_type = $request->tutoring_type;
        $student->manager = $next_manager_id;




        $student->save();
        return back()->with('message','Thank yor for requesting | your request successfully saved,');
    }





    public function update(Request $request){


        $t_subject = implode(", ",$request->t_subject);


        StudentProfile::where('id',$request->id)
            ->update([
                'title'      => $request->title,
                's_fullName' => $request->s_fullName,
                's_gender' => $request->s_gender,
                's_college' => $request->s_college,
                's_medium' => $request->s_medium,
                's_class' => $request->s_class,
                's_phoneNumber' => $request->s_phoneNumber,
                's_email' => $request->s_email,
                's_districts' => $request->s_districts,
                's_area' => $request->s_area,
                's_address' => $request->s_address,
                't_gender' => $request->t_gender,
                't_days' => $request->t_days,
                't_subject' => $t_subject,
                't_salary' => $request->t_salary,
                'ex_information' => $request->ex_info,
                'manager' => $request->manager,
            ]);
        return back()->with('message','seccessfully update');
    }








}
