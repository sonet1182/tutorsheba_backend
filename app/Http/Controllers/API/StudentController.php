<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AssignedTeacher;
use App\Models\confirmedTeacher;
use App\Models\Manager;
use App\Models\Notice;
use App\Models\rejectedTeacher;
use App\Models\RequestTeacher;
use App\Models\Student;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Models\TextMessage;
use App\Models\Transaction;
use App\Models\TuitionRequest;
use App\Models\User;
use App\Models\UsersVerify;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function info()
    {
        $student = Student::where('id', auth('sanctum')->user()->id)->first();
        $profile = "";

        return response()->json([
            'status' => 200,
            'data' => [
                'main_data' => $student,
                'profile_data' => $profile,
            ],
            'message' => 'Welcome to your profile'
        ]);
    }

    public function update_documents(Request $request)
    {
        $request->validate([
            'nid_card' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:300',
            'student_card' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:300',
        ]);

        $userV = UsersVerify::where('user_id', auth('sanctum')->user()->id)->first();

        if (!isset($userV)) {
            $imageUrl1 = $this->UploadDocImage($request, 'nid_card', 'nid_card/', '380', '250');
            $imageUrl2 = $this->UploadDocImage($request, 'student_card', 'student_card/', '380', '250');

            $verify = new UsersVerify();
            $verify->user_id = auth('sanctum')->user()->id;
            $verify->nid_card = $imageUrl1;
            $verify->student_card = $imageUrl2;
            $verify->save();
        } else {
            if (!isset($userV->nid_card)) {
                $imageUrl1 = $this->UploadDocImage($request, 'nid_card', 'nid_card/', '380', '250', $userV->nid_card);
                $userV->update([
                    'nid_card' => $imageUrl1,
                ]);
            }

            if (!isset($userV->student_card)) {
                $imageUrl2 = $this->UploadDocImage($request, 'student_card', 'student_card/', '380', '250', $userV->student_card);
                $userV->update([
                    'student_card' => $imageUrl2,
                ]);
            }
        }

        $teacher = TeacherProfile::where('user_id', auth('sanctum')->user()->id)->first();

        $teacher->update([
            'prog' => $teacher->calculateProfilePercentage(),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Profile Updated'
        ]);
    }

    public function update_personal_info(Request $request)
    {
        $user_id = auth('sanctum')->user()->id;
        $user = User::find($user_id);
        $teacher = TeacherProfile::where('user_id', $user->id)->first();

        $user->name = $request->teacher_name;
        $user->update();

        $imageUrl = $this->UploadImage($request, 'image', 'images/', '300', '300', $teacher->teacher_profile_picture);


        $teacher = tap($teacher)->update([
            'teacher_name' => $request->teacher_name,
            'a_phone_number' => $request->a_phone_number,
            'teacher_gender' => $request->teacher_gender,
            'teacher_university' => $request->teacher_university,
            'teacher_subject' => $request->teacher_subject,
            'teacher_degree' => $request->teacher_degree,
            'teacher_gender' => $request->teacher_gender,
            'teacher_bk_medium' => $request->teacher_bk_medium,
            'teacher_present_address' => $request->teacher_present_address,
            'teacher_permanent_address' => $request->teacher_permanent_address,
            'about_yourself' => $request->about_yourself,
            'teacher_profile_picture' => $imageUrl,
            'teacher_present_city' => $request->teacher_present_city,
            'a_phone_number' => $request->a_phone_number,
            'ex_phone_one' => $request->ex_phone_one,
            'ex_phone_two' => $request->ex_phone_two,
            'father_name' => $request->father_name,
            'father_phone' => $request->father_phone,
            'mother_name' => $request->mother_name,
            'mother_phone' => $request->mother_phone,
        ]);


        $teacher->update([
            'prog' => $teacher->calculateProfilePercentage(),
        ]);

        return response()->json([
            'status' => 200,
            'data' => [
                'main_data' => $user,
                'profile_data' => $teacher,
            ],
            'check' => $user_id,
            'message' => 'Personal Info has Updated Successfully'
        ]);
    }

    public function update_profile_photo(Request $request)
    {
        $teacher = TeacherProfile::where('user_id', auth('sanctum')->user()->id)->first();

        $imageUrl = $this->UploadImage($request, 'image', 'images/', '220', '220', $teacher->teacher_profile_picture);

        $teacher = tap($teacher)->update([
            'teacher_profile_picture' => $imageUrl,
        ]);


        $teacher->update([
            'prog' => $teacher->calculateProfilePercentage(),
        ]);

        $user = User::with('teacher', 'verification')->where('id', auth('sanctum')->user()->id)->first();
        $notification = TextMessage::where('user_id', $user->id)->where('status', 0)->count();

        return response()->json([
            'status' => 200,
            'data' => $user,
            'notification' => $notification,
            'message' => 'Profile Photo has Updated Successfully'
        ]);
    }

    public function update_educational_info(Request $request)
    {
        $teacher = TeacherProfile::where('user_id', auth('sanctum')->user()->id)->first();

        $teacher = tap($teacher)->update([
            'ssc_year' => $request->ssc_year,
            'ssc_institute' => $request->ssc_institute,
            'ssc_group' => $request->ssc_group,
            'ssc_gpa' => $request->ssc_gpa,
            'ssc_curriculam' => $request->ssc_curriculam,

            'hsc_year' => $request->hsc_year,
            'hsc_institute' => $request->hsc_institute,
            'hsc_group' => $request->hsc_group,
            'hsc_gpa' => $request->hsc_gpa,
            'hsc_curriculam' => $request->hsc_curriculam,

            'honours_insti_type' => $request->insti_type,
            'honours_study_type' => $request->study_type,
            'honours_year' => $request->honours_year,
            'honours_institute' => $request->honours_institute,
            'honours_subject' => $request->honours_subject,
            'honours_gpa' => $request->honours_gpa,
            'honours_curriculam' => $request->honours_curriculam,
        ]);



        $teacher->update([
            'prog' => $teacher->calculateProfilePercentage(),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Educational Info has Updated Successfully'
        ]);
    }


    public function update_tuition_info(Request $request)
    {
        $tuition_area = $request->tuition_area ? implode(", ", $request->tuition_area) : '';
        $tuition_subject = $request->tuition_subject ? implode(", ", $request->tuition_subject) : '';
        $tuition_medium = $request->tuition_medium ? implode(", ", $request->tuition_medium) : '';
        $tuition_class = $request->tuition_class ? implode(", ", $request->tuition_class) : '';
        $tuition_days = $request->tuition_days ? implode(", ", $request->tuition_days) : '';
        $tuition_shift = $request->tuition_shift ? implode(", ", $request->tuition_shift) : '';
        $tuition_style = $request->tuition_style ? implode(", ", $request->tuition_style) : '';

        $teacher = TeacherProfile::where('user_id', auth('sanctum')->user()->id)->first();

        $teacher = tap($teacher)->update([
            'district_id' => $request->district_id,
            'tuition_area' => $tuition_area,
            'tuition_subject' => $tuition_subject,
            'tuition_medium' => $tuition_medium,
            'tuition_class' => $tuition_class,
            'tuition_days' => $tuition_days,
            'tuition_shift' => $tuition_shift,
            'tuition_style' => $tuition_style,
            'tuition_salary' => $request->tuition_salary,
            'tuition_experience' => $request->tuition_experience,
        ]);

        $teacher->update([
            'prog' => $teacher->calculateProfilePercentage(),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Tuition Info has Updated Successfully'
        ]);
    }


    // Actions

    public function tuition_apply(Request $request)
    {
        $tuition = TuitionRequest::where('student_id', $request->student_id)->where('user_id', auth('sanctum')->user()->id)->first();
        $tuition_gender = StudentProfile::find($request->student_id)->t_gender;
        $my_gender = TeacherProfile::where('user_id', auth('sanctum')->user()->id)->first()->teacher_gender;

        if ($tuition == null) {
            if ($tuition_gender == 'Male' || $tuition_gender == 'Female') {
                if ($tuition_gender == $my_gender) {
                    $studentRequest = new TuitionRequest();
                    $studentRequest->student_id = $request->student_id;
                    $studentRequest->user_id = auth('sanctum')->user()->id;
                    $studentRequest->save();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Your Request successfully submitted'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'sorry',
                        'message' => 'Sorry! Preferred Gender Should Match with you!'
                    ]);
                }
            } else {
                $studentRequest = new TuitionRequest();
                $studentRequest->student_id = $request->student_id;
                $studentRequest->user_id = auth('sanctum')->user()->id;
                $studentRequest->save();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Your Request successfully submitted'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'already',
                'message' => 'Your Request already submitted for this tuition'
            ]);
        }
    }

    public function dashboard()
    {
        $user_id = auth('sanctum')->user()->id;
        $teacher = TeacherProfile::with('user', 'districts')->where('user_id', $user_id)->first();
        $notice = Notice::where('id', 1)->first();

        $applied = TuitionRequest::where('user_id', $user_id)->count();
        $assigned = AssignedTeacher::where('teacher_id', $user_id)->count();
        $confirmed = confirmedTeacher::where('teacher_id', $user_id)->count();
        $cancelled = rejectedTeacher::where('teacher_id', $user_id)->count();


        $tuition_area = $teacher->tuition_area;
        $tuitionAreas = explode(', ', $tuition_area);

        $matchedData = [];
        foreach ($tuitionAreas as $area) {
            $data = StudentProfile::with('districts', 'assigned')
                ->where('s_area', 'like', $area)
                ->where('approval', 1)
                ->where(function ($query) {
                    $query->where('approval', '!=', 5)
                        ->whereDoesntHave('assigned');
                })
                ->select(
                    'student_profile.id as id',
                    'student_profile.s_districts as s_districts',
                    'student_profile.s_area as s_area',
                    'student_profile.title as title',
                    'student_profile.tutoring_type as tutoring_type',
                    'student_profile.created_at as created_at',
                    'student_profile.s_medium as s_medium',
                    'student_profile.s_class as s_class',
                    'student_profile.t_subject as t_subject',
                    'student_profile.s_medium as s_medium',
                    'student_profile.t_salary as t_salary',
                    'student_profile.ex_information as ex_information',
                    'student_profile.approval as approval'
                )
                ->latest()
                ->get();



            if (!empty($data)) {
                $matchedData[] = $data;
            }
        }

        $combinedData = collect();
        foreach ($matchedData as $data) {
            $combinedData = $combinedData->merge($data);
        }

        $total = $combinedData->count();

        return response()->json([
            'status' => 200,
            'data' => [
                'teacher' => $teacher,
                'notice' => $notice,
                'applied' => $applied,
                'assigned' => $assigned,
                'confirmed' => $confirmed,
                'cancelled' => $cancelled,
                'total_jobs' => $total,
                'tuition_area' => $tuition_area,
            ],
        ]);
    }

    public function applyTuitionList($limit)
    {

        $teachers = TuitionRequest::where('user_id', auth('sanctum')->user()->id)->get();
        if ($teachers->count()) {

            foreach ($teachers as $teacher) {
                $items[] = $teacher->student_id;
            };

            $studentinfo = StudentProfile::with('districts')->whereIn('id', $items)->orderBy('id', 'desc')->paginate($limit);
        } else {
            $studentinfo = null;
        }

        return response()->json([
            'status' => 200,
            'data' => $studentinfo,
        ]);
    }

    public function assignedTuitionList($limit)
    {

        $teachers = assignedTeacher::where('teacher_id', auth('sanctum')->user()->id)->get();

        if ($teachers->count()) {

            foreach ($teachers as $teacher) {
                $items[] = $teacher->student_id;
            };

            $studentinfo = StudentProfile::with('districts')->whereIn('id', $items)->orderBy('id', 'desc')->paginate($limit);
        } else {
            $studentinfo = null;
        }

        return response()->json([
            'status' => 200,
            'data' => $studentinfo,
        ]);
    }

    public function confirmedTuitionList($limit)
    {

        $teachers = confirmedTeacher::with('districts')->where('teacher_id', auth('sanctum')->user()->id)->get();

        if ($teachers->count()) {

            foreach ($teachers as $teacher) {
                $items[] = $teacher->student_id;
            };

            $studentinfo = StudentProfile::whereIn('id', $items)->orderBy('id', 'desc')->paginate($limit);
        } else {
            $studentinfo = null;
        }

        return response()->json([
            'status' => 200,
            'data' => $studentinfo,
        ]);
    }

    public function cancelledTuitionList($limit)
    {

        $teachers = rejectedTeacher::where('teacher_id', auth('sanctum')->user()->id)->get();

        if ($teachers->count()) {

            foreach ($teachers as $teacher) {
                $items[] = $teacher->student_id;
            };

            $studentinfo = StudentProfile::with('districts')->whereIn('id', $items)->orderBy('id', 'desc')->paginate($limit);
        } else {
            $studentinfo = null;
        }

        return response()->json([
            'status' => 200,
            'data' => $studentinfo,
        ]);
    }

    public function tuition_matching_payments_list()
    {
        $tuitions = confirmedTeacher::with('student')->where('teacher_id', auth('sanctum')->user()->id)->latest()->get();
        return response()->json([
            'status' => 200,
            'data' => $tuitions,
        ]);
    }

    public function tuition_matching_transactions($id)
    {
        $txns = Transaction::where('confirmation_id', $id)->latest()->get();
        return response()->json([
            'status' => 200,
            'data' => $txns,
        ]);
    }


    public function profile_verification_req_submit()
    {
        $verification = Verification::where('user_id', auth('sanctum')->user()->id)->first();

        if (empty($verification)) {
            $verification = new Verification();
            $verification->user_id = auth('sanctum')->user()->id;
            $verification->profile_verification_request = 1;
            $verification->save();
        } else {
            $verification->profile_verification_request = 1;
            $verification->save();
        }

        $user = User::with('teacher', 'verification')->where('id', auth('sanctum')->user()->id)->first();

        return response()->json([
            'status' => 200,
            'data' => $user,
            'message' => "Request has been Send...",
        ]);
    }

    public function profile_premium_req_submit()
    {
        $verification = Verification::where('user_id', auth('sanctum')->user()->id)->first();

        if (empty($verification)) {
            $verification = new Verification();
            $verification->user_id = auth('sanctum')->user()->id;
            $verification->premium_verification_request = 1;
            $verification->save();
        } else {
            $verification->premium_verification_request = 1;
            $verification->save();
        }

        $user = User::with('teacher', 'verification')->where('id', auth('sanctum')->user()->id)->first();

        return response()->json([
            'status' => 200,
            'data' => $user,
            'message' => "Request has been Send...",
        ]);
    }

    public function notifications()
    {
        $notifications = TextMessage::where('user_id', auth('sanctum')->user()->id);

        $notifications->update(['status' => 1]);

        return response()->json([
            'status' => 200,
            'data' => $notifications->latest()->get(),
        ]);
    }


    public function teacherRequest(Request $request)
    {
        if ($request->tutor_id) {
            $teacher = TeacherProfile::where('teacher_id', $request->tutor_id)->first();
            $teachertutonrequst = new RequestTeacher();
            $teachertutonrequst->teacher_profile_id = $teacher->id;
            $teachertutonrequst->user_id = $teacher->user_id;
            $teachertutonrequst->teacher_id = $teacher->teacher_id;
            $teachertutonrequst->request_name = $request->request_name;
            $teachertutonrequst->request_phoneNumber = $request->request_phoneNumber;
            $teachertutonrequst->request_email = $request->request_email;
            $teachertutonrequst->request_info = $request->request_info;
            $teachertutonrequst->save();

            return response()->json([
                'status' => 200,
                'message' => 'Your request successfully submitted!',
            ]);
        }
    }


    public function tutorRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            's_fullName' => 'required',
            's_districts' => 'required',
            's_area' => 'required',
        ]);

        // $prev_student = StudentProfile::where('approval',1)->latest()->first();
        // $prev_manager_id = $prev_student->manager;
        // $manager_list = Manager::where('delete_status',0)->get();
        // $manager_max_id = $manager_list->max('id');
        // $manager_min_id = $manager_list->min('id');
        // if($prev_manager_id < $manager_max_id)
        // {
        //    $next_manager_id = $manager_list->where('id','>',$prev_manager_id)->where('delete_status',0)->first()->id;
        // }else{
        //     $next_manager_id = $manager_min_id;
        // }

        if ($validator->fails()) {
            return response()->json([
                'status' => 204,
                'message' => $validator->errors(),
            ]);
        } else {
            $student = new StudentProfile();
            $student->title = 'Tutor Request By Registered Guardian Form';
            $student->s_fullName = $request->s_fullName;
            $student->s_phoneNumber = auth('sanctum')->user()->phoneNumber;
            $student->s_email = $request->s_email;
            $student->s_gender = $request->s_gender;
            $student->s_college = $request->s_college;
            $student->s_class = $request->s_class;
            $student->s_medium = $request->s_medium;
            $student->s_districts = $request->s_districts;
            $student->s_area = $request->s_area;
            $student->s_address = $request->s_address;
            $student->t_gender = $request->t_gender;
            $student->t_subject = $request->t_subject;
            $student->t_days = $request->t_days;
            $student->time = $request->time;
            $student->t_salary = $request->t_salary;
            $student->ex_information = $request->ex_info;
            $student->s_number = $request->student_number;
            $student->tutoring_type = $request->tutoring_type;
            $student->student_id = auth('sanctum')->user()->id;
            $student->save();

            return response()->json([
                'status' => 200,
                'message' => 'Your request successfully submitted',
                'data' => '',
            ]);
        }
    }

    public function postedJobs()
    {
        $user_id = auth('sanctum')->user()->id;
        $includedColumns = ['id','s_fullName', 's_gender','approval'];
        $jobs = StudentProfile::with('confirmed','assigned')->where('student_id', $user_id)
            ->select($includedColumns)
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $jobs,
            'message' => 'Posted Job List',
        ]);
    }
}
