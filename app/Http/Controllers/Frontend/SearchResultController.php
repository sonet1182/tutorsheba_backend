<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AllArea;
use App\Models\AllDistrict;
use App\Models\AllMedium;
use App\Models\AnyClass;
use App\Models\AnySubject;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;

class SearchResultController extends Controller
{
    public function searchResult(Request $request)
    {
        $districts = $request->get('districts');
        $tuition_area = $request->get('area');
        $tuition_medium = $request->get('medium');
        $tuition_class = $request->get('class');
        $tuition_subject = $request->get('subject');
        $teacher_gender = $request->get('gender');
        //$salary_range = $request->get('salaryRange');
        $perPage = 21;

        //  Start elseif else condition
        //  All Input Search
        if (isset($districts,$tuition_area,$tuition_medium,$tuition_class,$tuition_subject,$teacher_gender) ) {
            $search = TeacherProfile::with('user')
                ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
                ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($teacher_gender == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_area == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_subject == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_area == '' && $teacher_gender == ''){
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        //    All Input Search without gender && subject && class
        elseif ($tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_area == '' && $tuition_subject == ''){
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        //    All Input Search without gender && subject && class && medium
        elseif ($tuition_medium == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }

        elseif ($tuition_area == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $teacher_gender == ''){
            $search = TeacherProfile::with('user','districts')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($districts == '' && $tuition_area == '' && $tuition_subject == ''){
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user')->where('district_id', 'LIKE', $districts)
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        //  only gender search
        elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $tuition_subject == ''){
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        // All Input  Search
        elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '')
        {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($districts == '' && $tuition_area == '' && $tuition_subject == '' && $teacher_gender == ''){
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($districts == '' && $tuition_area == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == ''){
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_subject == '' && $teacher_gender == ''){
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($districts == '' && $tuition_area == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_area == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_area == '' && $tuition_subject == '' && $teacher_gender == ''){
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_area == '' && $tuition_subject == '' && $tuition_medium == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_area == '' && $tuition_medium == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_area == '' && $tuition_medium == '' && $tuition_class == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' ){
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == ''){
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $teacher_gender == ''){
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($districts == '' && $tuition_area == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        elseif ($tuition_medium == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user')
            ->whereHas('user', function($q)
                {
                    $q->where('approval','=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate($perPage);
        }
        //  End elseif else condition

        $allDistrict = AllDistrict::all();
        $allArea = AllArea::all();
        $allMedium = AllMedium::all();
        $anyClass = AnyClass::all();
        $anySubject = AnySubject::orderBy('subjectName','asc')->get();
        // $salaryRange = salaryRange::all();

        // return $search;

        return view('frontend.pages.search_result',[
            'search'=> $search,
            'allDistrict'=> $allDistrict,
            'allArea'=> $allArea,
            'allMedium'=> $allMedium,
            'anyClass'=> $anyClass,
            'anySubject'=> $anySubject,
            'filtermale' => $filtermale->total(),
            'filterfemale' => $filterfemale->total(),
            'filterall' => $search->total(),
            'districts' => $districts,
            'tuition_area' => $tuition_area,
            'tuition_medium' => $tuition_medium,
            'tuition_class' => $tuition_class,
            'tuition_subject' => $tuition_subject,
            'teacher_gender' => $teacher_gender
        ]);
    }
}
