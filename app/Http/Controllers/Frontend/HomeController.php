<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdsImg;
use App\Models\AllArea;
use App\Models\AllDistrict;
use App\Models\AllMedium;
use App\Models\AnyClass;
use App\Models\AnySubject;
use App\Models\salaryRange;
use App\Models\SliderImg;
use App\Models\StudentProfile;
use App\Models\TuitionRequest;
use App\Models\User;
use App\Models\UserMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $allDistrict = AllDistrict::all();
        $allArea = AllArea::all();
        $allMedium = AllMedium::all();
        $anyClass = AnyClass::all();
        $anySubject = AnySubject::orderBy('subjectName','asc')->get();
        $salaryRange = salaryRange::all();

        $teacherProfile = UserMembership::
            leftjoin( 'teacher_profile as TP',
                'user_membership.tutor_id',
                '=',
                'TP.id' )
            ->leftjoin( 'users as U',
                        'TP.user_id',
                        '=',
                        'U.id' )
            ->leftjoin( 'all_districts as ADIS',
                        'TP.district_id',
                        '=',
                        'ADIS.id' )
            // ->where('TP.approval',1)
            ->where('user_membership.home_approval',1)
            ->select([
                        'TP.id',
                        'TP.teacher_id',
                        'TP.approval',
                        'U.name',
                        'U.phoneNumber',
                        'U.email',
                        'ADIS.districtName',
                        'TP.teacher_profile_picture',
                        'TP.a_phone_number',
                        'TP.teacher_gender',
                        'TP.teacher_university',
                        'TP.teacher_subject',
                        'TP.teacher_degree',
                        'TP.tuition_subject',
                        'TP.tuition_area',
                        'TP.tuition_experience',
                        'TP.teacher_bk_medium',
                        'TP.tuition_medium',
                        'TP.created_at'
                    ])

            // ->orderBy('id', 'DESC')
            ->get();

        $quary = UserMembership::whereHas('user')->leftjoin( 'teacher_profile as TP',
                                            'user_membership.tutor_id',
                                            '=',
                                            'TP.id' )
        ->leftjoin( 'users as U',
                    'TP.user_id',
                    '=',
                    'U.id' )
        ->where('TP.approval',1)
        ->select([
                    'TP.id',
                    'TP.teacher_id',
                    'TP.approval',
                    'U.name',
                    'TP.teacher_profile_picture',
                    'TP.a_phone_number',
                    'TP.teacher_gender',
                    'TP.teacher_university',
                    'TP.teacher_subject',
                    'TP.teacher_degree',
                    'TP.tuition_subject',
                    'TP.tuition_area',
                    'TP.tuition_experience',
                    'TP.teacher_bk_medium',
                    'TP.tuition_medium',
                    'TP.created_at'
                ]);

        $tutors = $quary->inRandomOrder()->limit(15)->get();


        $studentProfile = StudentProfile::with('districts')
            ->where('approval','=', 1)
            ->orderBy('id', 'DESC')
            ->get();
        $recentTutor = DB::table('teacher_profile')
            ->join('users', 'teacher_profile.user_id', '=', 'users.id')
            ->join('all_districts', 'teacher_profile.district_id', '=', 'all_districts.id')
            ->select('teacher_profile.*','users.name','users.email','users.phoneNumber', 'all_districts.districtName')
            ->where('teacher_profile.approval' ,'=', 1)
            ->orderBy('id', 'DESC')
            ->take(10)->get();

        $ads_images_top = AdsImg::where('activity',1)->where('position', 'home_top')->first();
        $ads_images_down = AdsImg::where('activity',1)->where('position', 'home_down')->first();

        $dhaka_total = User::whereHas('teacher', function($q)
            {
                $q->where('district_id',3);
            })->where('approval',1)->count();

        $chattogram_total = User::whereHas('teacher', function($q)
            {
                $q->where('district_id',4);
            })->where('approval',1)->count();
        $barishal_total = User::whereHas('teacher', function($q)
            {
                $q->where('district_id',8);
            })->where('approval',1)->count();
        $khulna_total = User::whereHas('teacher', function($q)
            {
                $q->where('district_id',7);
            })->where('approval',1)->count();
        $sylhet_total = User::whereHas('teacher', function($q)
            {
                $q->where('district_id',6);
            })->where('approval',1)->count();
        $rajshahi_total = User::whereHas('teacher', function($q)
            {
                $q->where('district_id',5);
            })->where('approval',1)->count();
        $rangpur_total = User::whereHas('teacher', function($q)
            {
                $q->where('district_id',9);
            })->where('approval',1)->count();
        $mymensingh_total = User::whereHas('teacher', function($q)
            {
                $q->where('district_id',10);
            })->where('approval',1)->count();


        $total_request = TuitionRequest::count();

        $banners = SliderImg::where('activity',1)->get();

        return view('frontend.pages.home',
            compact('banners','allDistrict','allArea','allMedium','anyClass','tutors',
                'anySubject','teacherProfile','studentProfile','recentTutor', 'ads_images_top', 'ads_images_down', 'dhaka_total', 'chattogram_total', 'barishal_total', 'khulna_total', 'sylhet_total', 'rajshahi_total', 'rangpur_total', 'mymensingh_total', 'total_request'));
    }

    public function featured(Request $request){
        $allDistrict = AllDistrict::all();
        $allArea = AllArea::all();
        $allMedium = AllMedium::all();
        $anyClass = AnyClass::all();
        $anySubject = AnySubject::orderBy('subjectName','asc')->get();
        $salaryRange = salaryRange::all();

        $quary = UserMembership::whereHas('user')->
        leftjoin( 'teacher_profile as TP',
                                            'user_membership.tutor_id',
                                            '=',
                                            'TP.id' )
        ->leftjoin( 'users as U',
                    'TP.user_id',
                    '=',
                    'U.id' )
        ->where('TP.approval',1)
        ->select([
                    'TP.id',
                    'TP.teacher_id',
                    'TP.approval',
                    'U.name',
                    'TP.teacher_profile_picture',
                    'TP.a_phone_number',
                    'TP.teacher_gender',
                    'TP.teacher_university',
                    'TP.teacher_subject',
                    'TP.teacher_degree',
                    'TP.tuition_subject',
                    'TP.tuition_area',
                    'TP.tuition_experience',
                    'TP.teacher_bk_medium',
                    'TP.tuition_medium',
                    'TP.created_at'
                ]);

        $quary_male = clone $quary;
        $quary_female = clone $quary;

        $filtermale = $quary_male->Where('teacher_gender', '=', 'male')
                ->orderBy('id','DESC')
                ->paginate(1);
        $filterfemale = $quary_female->Where('teacher_gender', '=', 'female')
                ->orderBy('id','DESC')
                ->paginate(1);

        $tutors = $quary->latest()->paginate(18)->onEachSide(1);

        if ($request->ajax()) {
    		$view = view('data',compact('tutors'))->render();
            return response()->json(['html'=>$view]);
        }


        return view('frontend.pages.featured_tutor',
            compact('allDistrict','allArea','allMedium','anyClass',
                'anySubject','salaryRange','tutors'),
            [
            'filtermale' => $filtermale->total(),
            'filterfemale' => $filterfemale->total(),
            'filterall' => $tutors->total()
            ]
        );
    }
}
