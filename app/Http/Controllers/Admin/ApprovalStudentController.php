<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\StudentProfile;
use Illuminate\Http\Request;

class ApprovalStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function studentApproval($id)
    {
        $prev_student = StudentProfile::where('approval', 1)->latest()->first();
        $prev_manager_id = $prev_student->manager;
        $manager_list = Manager::where('delete_status', 0)->get();

        $manager_max_id = $manager_list->max('id');
        $manager_min_id = $manager_list->min('id');


        if ($prev_manager_id < $manager_max_id) {
            $next_manager_id = $manager_list->where('id', '>', $prev_manager_id)->where('delete_status', 0)->first()->id;
        } else {
            $next_manager_id = $manager_min_id;
        }

        $tuition = StudentProfile::where('id', $id);

        $tuition->update([
            'approval' => 1,
            'manager' => $next_manager_id,
        ]);

        $user = $tuition->first();
        $message = "Thanks for selected us.your requested has been published on our Job Board. your desired tutor will be appointed within 2 days.Helpline 09613575388";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sms.net.bd/sendsms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'api_key' => '2dYuSnQNkQUUahkgg5f4EkMC414CIm0Kp7H0m1qH',
                'msg' => $message . " - Tutor Sheba",
                'to' => $user->s_phoneNumber
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

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
