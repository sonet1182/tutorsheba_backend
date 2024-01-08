<?php

namespace App\Http\Controllers\Admin;

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
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function searchResult(Request $request)
    {
        $districts = $request->get('districts');
        $tuition_area = $request->get('area');
        $tuition_medium = $request->get('medium');
        $tuition_class = $request->get('class');
        $tuition_subject = $request->get('subject');
        $teacher_gender = $request->get('gender');
        $teacher_university = $request->get('university');
        $teacher_subject = $request->get('subject');
        //$salary_range = $request->get('salaryRange');
        $perPage = 8;

        //  Start elseif else condition
        //  All Input Search
        if (isset($districts, $tuition_area, $tuition_medium, $tuition_class, $tuition_subject, $teacher_gender)) {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_area == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_subject == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_area == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        }
        //    All Input Search without gender && subject && class
        elseif ($tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_area == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        }
        //    All Input Search without gender && subject && class && medium
        elseif ($tuition_medium == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_area == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user')
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);;

            $filtermale = TeacherProfile::with('user')
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user')->where('district_id', 'LIKE', $districts)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        }
        //  only gender search
        elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user')
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        }
        // All Input  Search
        elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($districts == '' && $tuition_area == '') {
            $search = TeacherProfile::with('user')
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_area == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_area == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_area == '' && $tuition_subject == '' && $tuition_medium == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_area == '' && $tuition_medium == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_area == '' && $tuition_medium == '' && $tuition_class == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '') {
            $search = TeacherProfile::with('user')
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '') {
            $search = TeacherProfile::with('user')
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user')
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user')
                ->where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        } elseif ($tuition_medium == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->latest()
                ->paginate(50);

            $filtermale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->latest()
                ->paginate(50);

            $filterfemale = TeacherProfile::with('user')
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->latest()
                ->paginate(50);
        }
        //  End elseif else condition

        // return $search->count();

        $allDistrict = AllDistrict::all();
        $allArea = AllArea::all();
        $allMedium = AllMedium::all();
        $anyClass = AnyClass::all();
        $anySubject = AnySubject::orderBy('subjectName', 'asc')->get();
        // $salaryRange = salaryRange::all();


        return view('admin.layout.search-result', [
            'teacherProfile' => $search,
            'allDistrict' => $allDistrict,
            'allArea' => $allArea,
            'allMedium' => $allMedium,
            'anyClass' => $anyClass,
            'anySubject' => $anySubject,
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


        return view('admin.layout.search-result', [
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

        return view('admin.layout.search-result', [
            'teacherProfile' => $search,
        ]);
    }
}
