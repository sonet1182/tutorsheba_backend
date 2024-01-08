<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\AllArea;
use App\Models\AllDistrict;
use App\Models\AllMedium;
use App\Models\AnyClass;
use App\Models\AnySubject;
use App\Models\Department;
use App\Models\Institype;
use App\Models\Partner;
use App\Models\salaryRange;
use App\Models\SliderImg;
use App\Models\StudentProfile;
use App\Models\Studytype;
use App\Models\TeacherProfile;
use App\Models\TuitionRequest;
use App\Models\University;
use App\Models\User;
use App\Models\UserMembership;
use App\Models\PrivacyPolicyData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicDataController extends Controller
{
    //
    public function banner()
    {
        $banners = SliderImg::where('activity', 1)->get();

        return response()->json([
            'status' => 200,
            'banners' => $banners,
        ]);
    }

    public function statistics()
    {
        $total_request = TuitionRequest::count();
        $total_tutor = TeacherProfile::count();
        $total_tuition = StudentProfile::where('approval',1)->count();

        return response()->json([
            'status' => 200,
            'data' => [
                'total_request' => $total_request,
                'total_tutor' => $total_tutor,
                'total_tuition' => $total_tuition,
            ],
        ]);
    }

    public function salaryList()
    {
        $data = salaryRange::all();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }

    public function institype()
    {
        $data = Institype::all();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
    public function studytype()
    {
        $data = Studytype::all();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }

    public function uniList($type_id)
    {
        $data = University::where('type_id', $type_id)->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }

    public function privacypolicy()
    {
        $privacypolicy_data = PrivacyPolicyData::first();

        return response()->json([
            'status' => 200,
            'data' => $privacypolicy_data,
        ]);
    }

    public function dptList($type_id)
    {
        $data = Department::where('type_id', $type_id)->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }

    public function List($type_id)
    {
        $data = University::where('type_id', $type_id)->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }




    public function arealist($district_id)
    {
        $data = AllArea::where('district_id', $district_id)
            ->orderBy('areaName', 'asc')
            ->get();
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
    public function classlist($medium_id)
    {
        $data = AnyClass::where('medium_id', $medium_id)
            ->orderBy('className', 'asc')
            ->get();
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
    public function multi_classlist(Request $req)
    {
        $data = AnyClass::with('all_media')->whereIn('medium_id', $req->array)
            ->orderBy('className', 'asc')
            ->get();
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
    public function subjectlist($class_id)
    {
        $data = AnySubject::where('class_id', $class_id)
            ->orderBy('subjectName', 'asc')
            ->get();
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
    public function multi_subjectlist(Request $req)
    {
        $data = AnySubject::with('any_classes')->whereIn('class_id', $req->array)
            ->orderBy('subjectName', 'asc')
            ->get();
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
    public function allDistrict()
    {
        $data = AllDistrict::all();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
    public function allMedium()
    {
        $data = AllMedium::all();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }

    public function popular_tutor_list($limit)
    {
        $tutors = TeacherProfile::with('user', 'districts')
            ->whereHas('user', function ($q) {
                $q->where('approval', '=', 1);
            })
            ->where("home_approval", 1)
            ->latest()
            ->paginate($limit);

        return response()->json([
            'status' => 200,
            'data' => $tutors,
        ]);
    }

    public function tutor_details($id)
{
    $details = TeacherProfile::with('districts', 'owndistricts', 'studytype')
        ->join('users', 'teacher_profile.user_id', '=', 'users.id')
        ->select(
            'teacher_profile.teacher_profile_picture as teacher_profile_picture',
            'teacher_profile.teacher_id as teacher_id',
            'teacher_profile.user_id as user_id',
            'teacher_profile.district_id as district_id',
            'teacher_profile.honours_study_type as honours_study_type',
            'teacher_profile.honours_institute as honours_institute',
            'teacher_profile.teacher_present_city as teacher_present_city',
            'teacher_profile.teacher_university as teacher_university',
            'teacher_profile.honours_subject as honours_subject',
            'teacher_profile.teacher_subject as teacher_subject',
            'teacher_profile.teacher_gender as teacher_gender',
            'teacher_profile.tuition_salary as tuition_salary',
            'teacher_profile.tuition_days as tuition_days',
            'teacher_profile.tuition_style as tuition_style',
            'teacher_profile.tuition_medium as tuition_medium',
            'teacher_profile.tuition_class as tuition_class',
            'teacher_profile.tuition_subject as tuition_subject',
            'teacher_profile.tuition_shift as tuition_shift',
            'teacher_profile.ssc_year as ssc_year',
            'teacher_profile.ssc_institute as ssc_institute',
            'teacher_profile.ssc_group as ssc_group',
            'teacher_profile.ssc_gpa as ssc_gpa',
            'teacher_profile.hsc_year as hsc_year',
            'teacher_profile.hsc_institute as hsc_institute',
            'teacher_profile.hsc_group as hsc_group',
            'teacher_profile.hsc_gpa as hsc_gpa',
            'teacher_profile.honours_year as honours_year',
            'teacher_profile.honours_institute as honours_institute',
            'teacher_profile.honours_subject as honours_subject',
            'teacher_profile.honours_gpa as honours_gpa',
            'teacher_profile.tuition_area as tuition_area',
            'teacher_profile.teacher_present_address as teacher_present_address',
            'users.name as name',
            'users.verified as verified',
            'users.views as views',
            'users.created_at as created_at',
            'users.updated_at as updated_at'
        )
        ->where('teacher_id', $id)
        ->first();

        $teacher = User::find($details->user_id);
        $teacher->views = $teacher->views + 1;
        $teacher->update();

    return response()->json([
        'status' => 200,
        'data' => $details,
    ]);
}

    public function random_popular_tutor()
    {
        $tutors = TeacherProfile::with('districts')
        ->join('users', 'teacher_profile.user_id', '=', 'users.id')
            ->select(
                'teacher_profile.teacher_profile_picture as teacher_profile_picture',
                'teacher_profile.teacher_id as teacher_id',
                'teacher_profile.district_id as district_id',
                'teacher_profile.honours_institute as honours_institute',
                'teacher_profile.teacher_university as teacher_university',
                'teacher_profile.honours_subject as honours_subject',
                'teacher_profile.teacher_subject as teacher_subject',
                'teacher_profile.teacher_gender as teacher_gender',
                'users.name as name',
                'users.verified as verified',
                'users.created_at as created_at',
                'users.updated_at as updated_at'
            )
            ->whereHas('user', function ($q) {
                $q->where('approval', '=', 1);
            })
            ->where('home_approval', 1)
            ->inRandomOrder()->limit(15)->get();


        return response()->json([
            'status' => 200,
            'data' => $tutors,
        ]);
    }


    public function tutor_list(Request $request)
    {
        $districts = $request->district;
        $tuition_area = $request->area ? AllArea::find($request->area)->areaName : null;
        $tuition_medium = $request->medium ? AllMedium::find($request->medium)->mediumName : null;
        $tuition_class = $request->class ? AnyClass::find($request->class)->className : null;
        $tuition_subject = $request->subject;
        $teacher_gender = $request->gender;
        $teacher_type = $request->type == 'premium' ? 1 : 0;
        $perPage = 30;


        $search = TeacherProfile::with('districts')
            ->join('users', 'teacher_profile.user_id', '=', 'users.id')
            ->select(
                'teacher_profile.teacher_profile_picture as teacher_profile_picture',
                'teacher_profile.teacher_id as teacher_id',
                'teacher_profile.district_id as district_id',
                'teacher_profile.honours_institute as honours_institute',
                'teacher_profile.teacher_university as teacher_university',
                'teacher_profile.honours_subject as honours_subject',
                'teacher_profile.teacher_subject as teacher_subject',
                'teacher_profile.teacher_gender as teacher_gender',
                'users.name as name',
                'users.verified as verified',
                'users.created_at as created_at',
                'users.updated_at as updated_at'
            )
            ->whereHas('user', function ($q) {
                $q->where('approval', '=', 1);
            })
            ->where('district_id', 'LIKE', $districts)
            ->where('tuition_area', 'LIKE', "%$tuition_area%")
            ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
            ->where('tuition_class', 'LIKE', "%$tuition_class%")
            ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
            ->Where('teacher_gender', 'LIKE', $teacher_gender)
            ->where('home_approval', $teacher_type)
            ->orderBy('teacher_profile.created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'status' => 200,
            'data' => $search,
        ]);
    }



    public function tutor_list_old(Request $request)
    {
        $districts = $request->district;
        $tuition_area = $request->area ? AllArea::find($request->area)->areaName : null;
        $tuition_medium = $request->medium ? AllMedium::find($request->medium)->mediumName : null;
        $tuition_class = $request->class ? AnyClass::find($request->class)->className : null;
        $tuition_subject = $request->subject;
        $teacher_gender = $request->gender;
        $teacher_type = $request->type == 'premium' ? 1 : 0;
        //$salary_range = $request->get('salaryRange');
        $perPage = 30;

        //  Start elseif else condition
        //  All Input Search
        if (isset($districts, $tuition_area, $tuition_medium, $tuition_class, $tuition_subject, $teacher_gender)) {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_area == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_subject == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_area == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        }
        //    All Input Search without gender && subject && class
        elseif ($tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_area == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        }
        //    All Input Search without gender && subject && class && medium
        elseif ($tuition_medium == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_area == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user', 'districts')->where('district_id', 'LIKE', $districts)
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        }
        //  only gender search
        elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        }
        // All Input  Search
        elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($districts == '' && $tuition_area == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_area == '' && $tuition_class == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_medium', 'LIKE', $tuition_medium)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_area == '' && $tuition_subject == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_medium', 'LIKE', "%$tuition_medium%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_area == '' && $tuition_subject == '' && $tuition_medium == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_area == '' && $tuition_medium == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_class', 'LIKE', "%$tuition_class%")
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_area == '' && $tuition_medium == '' && $tuition_class == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->Where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('tuition_class', 'LIKE', "%$tuition_class%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_medium == '' && $tuition_class == '' && $teacher_gender == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_subject', 'LIKE', "%$tuition_subject%")
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($districts == '' && $tuition_area == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('tuition_medium', 'LIKE', $tuition_medium)
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        } elseif ($tuition_medium == '' && $tuition_class == '' && $tuition_subject == '') {
            $search = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filtermale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'male')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);

            $filterfemale = TeacherProfile::with('user', 'districts')
                ->whereHas('user', function ($q) {
                    $q->where('approval', '=', 1);
                })
                ->where('district_id', 'LIKE', $districts)
                ->where('tuition_area', 'LIKE', "%$tuition_area%")
                ->Where('teacher_gender', 'LIKE', $teacher_gender)
                ->where('teacher_gender', 'LIKE', 'female')
                ->where('home_approval', $teacher_type)
                ->latest()
                ->paginate($perPage);
        }
        //  End elseif else condition

        $allDistrict = AllDistrict::all();
        $allArea = AllArea::all();
        $allMedium = AllMedium::all();
        $anyClass = AnyClass::all();
        $anySubject = AnySubject::orderBy('subjectName', 'asc')->get();
        // $salaryRange = salaryRange::all();

        return response()->json([
            'status' => 200,
            'data' => $search,
        ]);
    }

    public function divisional_tutors()
    {
        $dhaka_total = User::whereHas('teacher', function ($q) {
            $q->where('district_id', 3);
        })->where('approval', 1)->count();

        $chattogram_total = User::whereHas('teacher', function ($q) {
            $q->where('district_id', 4);
        })->where('approval', 1)->count();
        $barishal_total = User::whereHas('teacher', function ($q) {
            $q->where('district_id', 8);
        })->where('approval', 1)->count();
        $khulna_total = User::whereHas('teacher', function ($q) {
            $q->where('district_id', 7);
        })->where('approval', 1)->count();
        $sylhet_total = User::whereHas('teacher', function ($q) {
            $q->where('district_id', 6);
        })->where('approval', 1)->count();
        $rajshahi_total = User::whereHas('teacher', function ($q) {
            $q->where('district_id', 5);
        })->where('approval', 1)->count();
        $rangpur_total = User::whereHas('teacher', function ($q) {
            $q->where('district_id', 9);
        })->where('approval', 1)->count();
        $mymensingh_total = User::whereHas('teacher', function ($q) {
            $q->where('district_id', 10);
        })->where('approval', 1)->count();

        return response()->json([
            'status' => 200,
            'data' => [
                'dhaka_total' => $dhaka_total,
                'chattogram_total' => $chattogram_total,
                'barishal_total' => $barishal_total,
                'khulna_total' => $khulna_total,
                'sylhet_total' => $sylhet_total,
                'rajshahi_total' => $rajshahi_total,
                'rangpur_total' => $rangpur_total,
                'mymensingh_total' => $mymensingh_total,
            ],
        ]);
    }

    public function tutor_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            's_fullName' => 'required',
            's_phoneNumber' => 'required|regex:/(01)[0-9]{9}/',
            's_districts' => 'required',
            's_area' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 204,
                'message' => $validator->errors(),
            ]);
        } else {
            $student = new StudentProfile();
            $student->title = 'Tutor Request By Guardian Form';
            $student->s_fullName = $request->s_fullName;
            $student->s_phoneNumber = $request->s_phoneNumber;
            //   $student->s_email = $request->s_email;
            $student->s_gender = $request->s_gender;
            $student->s_college = $request->s_college;
            $student->s_class = $request->s_class;
            $student->s_medium = AllMedium::find($request->s_medium)->mediumName;
            $student->s_districts = $request->s_districts;
            $student->s_area = $request->s_area;
            $student->s_address = $request->s_address;
            $student->t_gender = $request->t_gender;
            $student->t_subject = '';
            $student->t_days = $request->t_days;
            $student->t_salary = $request->t_salary;
            $student->ex_information = $request->ex_information;
            $student->save();

            return response()->json([
                'status' => 200,
                'message' => 'Thank yor for requesting | your request successfully saved,',
            ]);
        }
    }


    public function ref_tutor_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            's_fullName' => 'required',
            's_phoneNumber' => 'required|regex:/(01)[0-9]{9}/',
            's_districts' => 'required',
            's_area' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 204,
                'message' => $validator->errors(),
            ]);
        } else {

            $partner_id = Partner::where('ref_id', $request->ref_id)->first()->id;

            $student = new StudentProfile();
            $student->title = 'Tutor Request From Passive Lead Generation';
            $student->s_fullName = $request->s_fullName;
            $student->s_phoneNumber = $request->s_phoneNumber;
            //   $student->s_email = $request->s_email;
            $student->s_gender = $request->s_gender;
            $student->s_college = $request->s_college;
            $student->s_class = $request->s_class;
            $student->s_medium = AllMedium::find($request->s_medium)->mediumName;
            $student->s_districts = $request->s_districts;
            $student->s_area = $request->s_area;
            $student->s_address = $request->s_address;
            $student->t_gender = $request->t_gender;
            $student->t_subject = '';
            $student->t_days = $request->t_days;
            $student->t_salary = $request->t_salary;
            $student->ex_information = $request->ex_information;

            $student->lead_generator = $partner_id;
            $student->lead_type = 1;

            $student->save();

            return response()->json([
                'status' => 200,
                'message' => 'Thank yor for requesting | your request successfully saved,',
            ]);
        }
    }
}
