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
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TuitionController extends Controller
{
    public function tuition(Request $request) {

        $allDistrict = AllDistrict::all();
        $allArea = AllArea::all();
        $allMedium = AllMedium::all();
        $anyClass = AnyClass::all();
        $anySubject = AnySubject::orderBy('subjectName','asc')->get();
        $salaryRange = salaryRange::all();

        $tuitions = StudentProfile::with('districts')
            ->where('approval',1)->latest()->paginate(8)->onEachSide(1);

        $filtermale = StudentProfile::with('districts')
            ->where('approval',1)->where('student_profile.t_gender', 'Male')->count();

        $filterfemale = StudentProfile::with('districts')
            ->where('approval',1)->where('student_profile.t_gender', 'Female')->count();

        $filteranygender = StudentProfile::with('districts')
            ->where('approval',1)->where('student_profile.t_gender', 'Any Gender')->count();

        $total = StudentProfile::with('districts')
            ->where('approval',1)->count();

        if (request()->ajax()) {

            $quary = StudentProfile::with('districts')
            ->where('approval',1);

            if(!empty(request()->districts_value))
            {
                $quary->where('s_districts', request()->districts_value);
            }

            if(!empty(request()->area_value))
            {
                $quary->where('s_area', request()->area_value);
            }

            if(!empty(request()->medium_value))
            {
                $quary->where('s_medium', request()->medium_value);
            }

            if(!empty(request()->class_value))
            {
                $quary->where('s_class', request()->class_value);
            }

            if(!empty(request()->subject_value))
            {
                $quary->where('t_subject', request()->subject_value);
            }

            if(!empty(request()->gender_value))
            {
                $quary->where('s_gender', request()->gender_value);
            }

            $alltuitions = $quary->latest()->paginate(8);

            $total = $quary->count();

            $html = view('tuition')->with(compact('alltuitions'))->render();
            $paginate = view('tuition_paginate')->with(compact('alltuitions'))->render();

            return response()->json(['success' => true, 'html' => $html, 'paginate' => $paginate, 'total' => $total]);

        }

        $ads_images_tuition_job = AdsImg::where('activity',1)->where('position', 'tuition_job')->first();

        return view('frontend.pages.tuition.list',
            compact('allDistrict','allArea','allMedium','anyClass',
                'anySubject','salaryRange','tuitions','filtermale','filterfemale','filteranygender','total','ads_images_tuition_job')
        );
    }

    public function tuitionView($id) {
        if(Auth::user())
        {
            $teacher = TeacherProfile::where('user_id',Auth::user()->id)->first();
            $prog = $teacher -> prog;
        }
        else
        {
            $prog = 0;
        }

        $tuition = StudentProfile::where('id',$id)->first();
        return view('frontend.pages.tuition.view')->with(compact('tuition','prog'));
    }
}
