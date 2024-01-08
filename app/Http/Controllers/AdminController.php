<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AllArea;
use App\Models\AllDistrict;
use App\Models\AllMedium;
use App\Models\AnyClass;
use App\Models\AnySubject;
use App\Models\Institype;
use App\Models\Partner;
use App\Models\RequestTeacher;
use App\Models\salaryRange;
use App\Models\StudentProfile;
use App\Models\Studytype;
use App\Models\TeacherProfile;
use App\Models\TuitionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

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

       return view('admin.layout.home',
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


    public function ChangePassword(){

        return view('admin.layout.changepass');
    }


    public function Passwordreq(Request $request,$id){

        $request->validate([
                    'email'=>'required',
                    'OldPassword'=>'required',
                    'NewPassword'=>'required|confirmed'
            ]);


             $oldpass=(Auth::user()->password);
           if(Hash::check($request->OldPassword,$oldpass)){
                    if(!Hash::check($request->NewPassword,$oldpass)){
                        $user=Admin::find(Auth::user()->id);
                        $user->password=Hash::make($request->NewPassword);
                        $user->email=$request->email;
                        $user->save();

                         Auth::logout();
                        return redirect()->back()->with('status','Password Successfully Changed');
                    }else{

                             return redirect()->back()->with('status','Old password cannot be The New Password');
                    }
           }

            else{
           return redirect()->back()->with('status','Invalid Password');

           }


    }
}
