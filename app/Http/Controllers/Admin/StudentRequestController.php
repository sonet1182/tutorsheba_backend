<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignedTeacher;
use App\Models\confirmedTeacher;
use App\Models\Manager;
use App\Models\Partner;
use App\Models\rejectedTeacher;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Models\Transaction;
use App\Models\TuitionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function newStudentRequest()
    {
        $studentProfile = StudentProfile::with('manager_info')->where('student_profile.approval', '=', 0)
            ->latest()->get();

        return view('admin.layout.student.new_tuition_request', compact('studentProfile'));
    }


    public function approvalStudentList()
    {
        $studentProfile = StudentProfile::with('manager_info')->where('student_profile.approval', '=', 1)
            ->orWhere('student_profile.approval', '=', 4)
            ->orWhere('student_profile.approval', '=', 5)
            ->orderBy('id', 'DESC')
            ->paginate(20);
        $manager_list = Manager::where('delete_status', 0)->get();
        $manager = 0;
        return view('admin.layout.student.approval_student_list', compact('studentProfile', 'manager_list', 'manager'));
    }

    public function add_note(Request $req, $id)
    {
        $studentProfile = StudentProfile::find($id);

        $studentProfile->note = $req->input('note');
        $studentProfile->save();

        return back()->with('status', 'Note Added Successfully!');
    }


    public function tuition_search_by_manager($id)
    {
        $studentProfile = StudentProfile::with('manager_info')
            ->where('manager', $id)
            ->orderBy('id', 'DESC')
            ->paginate(20);

        $manager_list = Manager::where('delete_status', 0)->get();
        $manager = $id;
        return view('admin.layout.student.approval_student_list', compact('studentProfile', 'manager_list', 'manager'));
    }

    public function tuition_search_by_id(Request $req)
    {
        $studentProfile = StudentProfile::with('manager_info')
            ->where('id', $req->job_id)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('admin.layout.student.search_result_list', compact('studentProfile'));
    }

    public function tuition_search_by_phone(Request $req)
    {
        if ($req->phone) {
            $studentProfile = StudentProfile::with('manager_info')
                ->where('s_phoneNumber', 'like', '%' . $req->phone . '%')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        } else {
            $studentProfile = null;
        }

        return view('admin.layout.student.search_result_list', compact('studentProfile'));
    }

    public function rejectedStudentList()
    {
        $studentProfile = DB::table('student_profile')
            ->join('managers', 'student_profile.manager', '=', 'managers.id')
            ->join('all_districts', 'student_profile.s_districts', '=', 'all_districts.id')
            ->select('student_profile.*', 'managers.name as m_name', 'all_districts.districtName')
            ->where('student_profile.approval', '=', 3)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('admin.layout.student.rejected_student_list', compact('studentProfile'));
    }

    public function setPending($id)
    {
        $studentProfile = StudentProfile::find($id);
        $studentProfile->approval = 4;
        $studentProfile->save();

        return back()->with('status', 'Status Updated Successfully!');
    }

    public function setCancel($id)
    {
        $studentProfile = StudentProfile::find($id);
        $studentProfile->approval = 5;
        $studentProfile->save();

        return back()->with('status', 'Status Updated Successfully!');
    }

    public function pendingStudentList()
    {
        $studentProfile = StudentProfile::with('manager_info')->where('student_profile.approval', '=', 4)
            ->orderBy('id', 'DESC')
            ->paginate(20);
        $manager_list = Manager::where('delete_status', 0)->get();
        $manager = 0;
        return view('admin.layout.student.pending_student_list', compact('studentProfile', 'manager_list', 'manager'));
    }

    public function cancelStudentList()
    {
        $studentProfile = StudentProfile::with('manager_info')->where('student_profile.approval', '=', 5)
            ->orderBy('id', 'DESC')
            ->paginate(20);
        $manager_list = Manager::where('delete_status', 0)->get();
        $manager = 0;
        return view('admin.layout.student.cancelled_student_list', compact('studentProfile', 'manager_list', 'manager'));
    }


    public function studentDetails($id)
    {
        $studentDetails = DB::table('student_profile')
            ->join('all_districts', 'student_profile.s_districts', '=', 'all_districts.id')
            ->select('student_profile.*', 'all_districts.districtName')
            ->where('student_profile.id', '=', $id)->first();

        if ($studentDetails) {
            if ($studentDetails->t_gender == 'Male') {
                $teacher_profile = TeacherProfile::with('user', 'districts')->whereHas('user')
                    ->where('tuition_area', 'like', '%' . $studentDetails->s_area . '%')
                    ->where('tuition_subject', 'like', '%' . $studentDetails->t_subject . '%')
                    ->where('tuition_class', 'like', '%' . $studentDetails->s_class . '%')
                    ->where('teacher_gender', 'Male');
            } elseif ($studentDetails->t_gender == 'Female') {
                $teacher_profile = TeacherProfile::with('user', 'districts')->whereHas('user')
                    ->where('tuition_area', 'like', '%' . $studentDetails->s_area . '%')
                    ->where('tuition_subject', 'like', '%' . $studentDetails->t_subject . '%')
                    ->where('tuition_class', 'like', '%' . $studentDetails->s_class . '%')
                    ->where('teacher_gender', 'Female');
            } else {
                $teacher_profile = TeacherProfile::with('user', 'districts')->whereHas('user')
                    ->where('tuition_area', 'like', '%' . $studentDetails->s_area . '%')
                    ->where('tuition_subject', 'like', '%' . $studentDetails->t_subject . '%')
                    ->where('tuition_class', 'like', '%' . $studentDetails->s_class . '%');
            }

            $teacher =    $teacher_profile->orderBy('id', 'DESC')
                ->paginate(10);

            $applied_teacher = TuitionRequest::where('student_id', $id)->get();
            $confirmed = confirmedTeacher::where('student_id', $id)->latest()->first();
            $assigned_list = AssignedTeacher::where('student_id', $id)->latest()->get();
            $rejected_list = rejectedTeacher::where('student_id', $id)->latest()->get();

            $partner = Partner::find($studentDetails->lead_generator);
        }


        return view('admin.layout.student.student_details', compact('studentDetails', 'teacher', 'applied_teacher', 'confirmed', 'assigned_list', 'rejected_list','partner'));
    }

    public function receiver_list($id)
    {
        $studentDetails = DB::table('student_profile')
            ->join('all_districts', 'student_profile.s_districts', '=', 'all_districts.id')
            ->select('student_profile.*', 'all_districts.districtName')
            ->where('student_profile.id', '=', $id)->first();

        if ($studentDetails) {
            if ($studentDetails->t_gender == 'Male') {
                $teacher_profile = TeacherProfile::with('user', 'districts')->whereHas('user')
                    ->where('tuition_area', 'like', '%' . $studentDetails->s_area . '%')
                    ->where('tuition_subject', 'like', '%' . $studentDetails->t_subject . '%')
                    ->where('tuition_class', 'like', '%' . $studentDetails->s_class . '%')
                    ->where('teacher_gender', 'Male');
            } elseif ($studentDetails->t_gender == 'Female') {
                $teacher_profile = TeacherProfile::with('user', 'districts')->whereHas('user')
                    ->where('tuition_area', 'like', '%' . $studentDetails->s_area . '%')
                    ->where('tuition_subject', 'like', '%' . $studentDetails->t_subject . '%')
                    ->where('tuition_class', 'like', '%' . $studentDetails->s_class . '%')
                    ->where('teacher_gender', 'Female');
            } else {
                $teacher_profile = TeacherProfile::with('user', 'districts')->whereHas('user')
                    ->where('tuition_area', 'like', '%' . $studentDetails->s_area . '%')
                    ->where('tuition_subject', 'like', '%' . $studentDetails->t_subject . '%')
                    ->where('tuition_class', 'like', '%' . $studentDetails->s_class . '%');
            }

            $teacher =    $teacher_profile->orderBy('id', 'DESC')
                ->get();
        }

        return view('admin.layout.student.receiver_list', compact('teacher'));
    }

    public function applied_receiver_list($id)
    {
        $teacher = TuitionRequest::where('student_id', $id)->get();

        return view('admin.layout.student.applied_receiver_list', compact('teacher'));
    }

    public function find_teacher(Request $req)
    {
        if ($req->teacher_id != NULL) {
            $teacher = User::where('id', $req->teacher_id)->with('teacher')->first();
        } elseif ($req->teacher_phone != NULL) {
            $teacher = User::where('phoneNumber', $req->teacher_phone)->with('teacher')->first();
        }

        $student_id = $req->student_id;
        $confirmed = $req->confirmed;

        if ($teacher)
            return view('admin.layout.student.ajax_teacher_profile', compact('teacher', 'student_id', 'confirmed'));
        else
            return 'Teacher Not Found!';


        // return response()->json([
        //             'type' => 'success',
        //             'data' => $teacher,
        //             'message' => 'Admin Added Successfully'
        //         ]);
    }

    public function assign_teacher(Request $req)
    {
        $rejected = rejectedTeacher::where('student_id', $req->input('student_id'))->where('teacher_id', $req->input('teacher_id'))->first();
        if ($rejected) {
            $rejected->delete();
        }

        $assign = new AssignedTeacher();
        $assign->teacher_id = $req->input('teacher_id');
        $assign->student_id = $req->input('student_id');
        $assign->assigned_by = $req->input('assigned_by');
        $assign->remark = $req->input('remark');
        $assign->save();


        return back()->with('status', 'Teacher Assigned Successfully');
    }

    public function assign_teacher_edit(Request $req, $id)
    {
        $assign = AssignedTeacher::find($id);
        $assign->assigned_by = $req->input('assigned_by');
        $assign->remark = $req->input('remark');
        $assign->save();

        return back()->with('status', 'Assigned teacher info Updated Successfully!');
    }

    public function confirmed_teacher_edit(Request $req, $id)
    {
        $conf = confirmedTeacher::find($id);
        $conf->fee = $req->input('fee');
        $conf->discount = $req->input('discount');
        $conf->due = ($conf->fee - $conf->discount) - $conf->paid;
        $conf->remark = $req->input('remark');
        $conf->save();

        return back()->with('status', 'Confirmed teacher info Updated Successfully!');
    }

    public function confirm_teacher(Request $req)
    {
        $manager_id = studentProfile::find($req->input('student_id'))->manager;

        $assign = new confirmedTeacher();
        $assign->teacher_id = $req->input('teacher_id');
        $assign->student_id = $req->input('student_id');
        $assign->confirmed_by = $req->input('confirmed_by');
        $assign->remark = $req->input('remark');
        $assign->fee = $req->input('fee');
        if ($req->input('advance')) {
            $assign->paid = $req->input('advance');
            $assign->due = $req->input('fee') - $req->input('advance');
        } else {
            $assign->due = $req->input('fee');
        }

        $assign->save();


        if (!empty($req->lead_percentage)) {
            $student = StudentProfile::find($req->student_id);
            // $student->lead_percentage = $req->lead_percentage;
            $student->lead_comission = $req->lead_percentage;
            $student->lead_due = $student->lead_comission;
            $student->t_salary = $req->salary;
            $student->save();

            $partner = Partner::find($student->lead_generator);
            $partner->due = $partner->due + $student->lead_due;
            $partner->save();
        }

        if ($req->input('advance')) {
            $txn = new Transaction();
            $txn->confirmation_id = $assign->id;
            $txn->teacher_id = $req->input('teacher_id');
            $txn->payment = $req->input('advance');
            $txn->manager = $manager_id;
            $txn->save();
        }

        return back()->with('status', 'Teacher Confirmed Successfully');
    }

    public function reject_teacher(Request $req)
    {
        $assigned = AssignedTeacher::where('student_id', $req->input('student_id'))->where('teacher_id', $req->input('teacher_id'))->first();

        if ($assigned) {
            $assigned->delete();
        }


        $reject = new rejectedTeacher();
        $reject->teacher_id = $req->input('teacher_id');
        $reject->student_id = $req->input('student_id');
        $reject->rejected_by = $req->input('rejected_by');
        $reject->reason = $req->input('reason');
        $reject->save();


        return back()->with('status', 'Teacher Rejected Successfully');
    }

    public function payment_sheet()
    {
        $confirmations = confirmedTeacher::latest()->paginate(30);

        $total_fee = confirmedTeacher::sum('fee');
        $total_discount = confirmedTeacher::sum('discount');
        $total_paid = confirmedTeacher::sum('paid');
        $total_due = confirmedTeacher::sum('due');


        $manager_list = Manager::where('delete_status', 0)->get();
        $manager = 0;
        $manager_name = 'Total';


        return view('admin.layout.student.payment_sheet', compact('confirmations', 'manager_list', 'manager', 'total_fee', 'total_discount', 'total_paid', 'total_due', 'manager_name'));
    }

    public function payment_tuition_search_by_id(Request $req)
    {
        $confirmations = confirmedTeacher::where('student_id', $req->job_id)->latest()->paginate(100);
        $manager_list = Manager::where('delete_status', 0)->get();
        $manager = 0;
        return view('admin.layout.student.payment_search_result', compact('confirmations', 'manager_list', 'manager'));
    }

    public function payment_tuition_search_by_phone(Request $req)
    {
        if ($req->phone) {
            $confirmations = confirmedTeacher::whereHas('teacher', function ($q) use ($req) {
                $q->where('phoneNumber', 'like', '%' . $req->phone . '%');
            })->latest()->paginate(100);
        } else {
            $confirmations = null;
        }

        $manager_list = Manager::where('delete_status', 0)->get();
        $manager = 0;

        return view('admin.layout.student.payment_search_result', compact('confirmations', 'manager_list', 'manager'));
    }

    public function payment_tuition_search_by_manager($id)
    {
        $all_confirmations = confirmedTeacher::whereHas('student', function ($q) use ($id) {
            $q->where('manager', $id);
        });

        $confirmations = $all_confirmations->latest()->paginate(100);

        $total_fee = $all_confirmations->sum('fee');
        $total_discount = $all_confirmations->sum('discount');
        $total_paid = $all_confirmations->sum('paid');
        $total_due = $all_confirmations->sum('due');

        $manager_list = Manager::where('delete_status', 0)->get();
        $manager = $id;
        $manager_name = Manager::find($id)->name;

        return view('admin.layout.student.payment_sheet', compact('confirmations', 'manager_list', 'manager', 'total_fee', 'total_discount', 'total_paid', 'total_due', 'manager_name'));
    }


    public function payment_details($id)
    {
        $studentDetails = DB::table('student_profile')
            ->join('all_districts', 'student_profile.s_districts', '=', 'all_districts.id')
            ->select('student_profile.*', 'all_districts.districtName')
            ->where('student_profile.id', '=', $id)->first();

        $confirmed = confirmedTeacher::where('student_id', $id)->latest()->first();
        $transactions = Transaction::where('confirmation_id', $confirmed->id)->latest()->get();

        return view('admin.layout.student.payment_details', compact('studentDetails', 'confirmed', 'transactions'));
    }

    public function payment_submit($id, Request $req)
    {
        // $rejected = confirmedTeacher::where('student_id',$req->input('student_id'))->where('teacher_id',$req->input('teacher_id'))->first();
        // if($rejected)
        // {
        //     $rejected->delete();
        // }

        $assign = confirmedTeacher::find($id);
        $assign->paid = $assign->paid + $req->input('payment');
        $assign->due = ($assign->fee - $assign->discount) - $assign->paid;
        $assign->save();

        $manager_id = studentProfile::find($assign->student_id)->manager;

        $txn = new Transaction();
        $txn->confirmation_id = $assign->id;
        $txn->teacher_id = $req->input('teacher_id');
        $txn->payment = $req->input('payment');
        $txn->remark = $req->input('remark');
        $txn->manager = $manager_id;
        $txn->save();


        return back()->with('status', 'Payment Submitted Successfully');
    }


    public function transactions2()
    {
        $transactions = Transaction::orderBy('created_at', 'DESC')->paginate(30);
        $total = Transaction::sum('payment');

        $manager_list = Manager::where('delete_status', 0)->get();
        $manager = 0;
        $manager_name = 'Total';

        return view('admin.layout.student.transactions', compact('transactions', 'manager_list', 'manager', 'total', 'manager_name'));
    }

    public function transactions(Request $request)
    {
        $transactions = Transaction::query();
        $transactions->when($request->from, function ($q) use ($request) {
            return $q->whereDate('created_at', '>=', $request->from);
        });

        $transactions->when($request->to, function ($q) use ($request) {
            return $q->whereDate('created_at', '<=', $request->to);
        });

        $transactions->when($request->manager, function ($q) use ($request) {
            return $q->where('manager', $request->manager);
        });

        $total = $transactions->sum('payment');
        $transactions = $transactions->latest()->paginate(30);
        $manager_list = Manager::where('delete_status', 0)->get();
        $manager = $request->manager ?? 0;
        $manager_name = $request->manager==0?'Total': Manager::where('id',$request->manager)->value('name');

        return view('admin.layout.student.transactions', compact('transactions', 'manager_list', 'manager', 'manager_name', 'total'));
    }

    public function update_transactions($id, Request $req)
    {
        $txn = transaction::find($id);
        $fraction = $txn->payment - $req->input('payment');
        $txn->payment = $req->input('payment');
        $txn->remark = $req->input('remark');
        $txn->save();


        $assign = confirmedTeacher::find($txn->confirmation_id);
        $assign->paid = $assign->paid - $fraction;
        $assign->due = ($assign->fee - $assign->discount) - $assign->paid;
        $assign->save();


        return back()->with('status', 'Transaction Updated Successfully');
    }

    public function transactions_search(Request $req)
    {
        $start_date = $req->input('from');
        $end_date = $req->input('to');

        if ($req->input('manager') == 0) {
            $all_transactions = Transaction::whereDate('created_at', '>=', $start_date . ' 00:00:00')
                ->whereDate('created_at', '<=', $end_date . ' 00:00:00');
            $manager = 0;
            $manager_name = 'Total';
        } else {
            $all_transactions = Transaction::where('manager', $req->input('manager'))
                ->whereDate('created_at', '>=', $start_date . ' 00:00:00')
                ->whereDate('created_at', '<=', $end_date . ' 00:00:00');
            $manager = $req->input('manager');
            $manager_name = Manager::find($req->input('manager'))->name;
        }

        $total = $all_transactions->sum('payment');
        $transactions = $all_transactions->latest()->paginate(30)->withQueryString();;
        // $transactions->appends($req->all());
        $manager_list = Manager::where('delete_status', 0)->get();

        return view('admin.layout.student.transactions', compact('transactions', 'manager_list', 'manager', 'total', 'manager_name'));
    }



    public function studentApproval($id)
    {
        $prev_student = StudentProfile::where('approval', 1)->latest()->first();


        //        if ($tuition){
        //           $student = StudentProfile::where('id',$id)->first();
        //           $teacher = TeacherProfile::with('user')->where('tuition_area', 'LIKE', "%$student->s_area%")->get();
        //            Mail::to($teacher->user)->send(new NewTuitionAlert());
        //        }


        $prev_manager_id = $prev_student->manager;


        $manager_list = Manager::where('delete_status', 0)->get();

        $manager_max_id = $manager_list->max('id');
        $manager_min_id = $manager_list->min('id');


        if ($prev_manager_id < $manager_max_id) {
            $next_manager_id = $manager_list->where('id', '>', $prev_manager_id)->where('delete_status', 0)->first()->id;
        } else {
            $next_manager_id = $manager_min_id;
        }

        $tuition = StudentProfile::where('id', $id)->update([
            'approval' => 1,
            'manager' => $next_manager_id,
        ]);


        return redirect()->back()->with('app', 'This Tuition Account Approved');
    }
    public function studentRejected($id)
    {
        $tuition = StudentProfile::find($id);
        $tuition->approval = 3;
        $tuition->save();
        return redirect()->back()->with('rej', 'This Tuition Account Rejected');
    }
}
