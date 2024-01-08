<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\TextMessage;
use App\Models\User;
use Illuminate\Http\Request;


class TextMessageController extends Controller
{
    function send_text(Request $req)
    {
        $user = User::find($req->input('id'));
        $message = $req->input('message');

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.sms.net.bd/sendsms',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'api_key' => '2dYuSnQNkQUUahkgg5f4EkMC414CIm0Kp7H0m1qH',
                    'msg' => $message." - Tutor Sheba",
                    'to' => $user->phoneNumber
                ),
            ));
            $response = curl_exec($curl);

            curl_close($curl);

            $text = new TextMessage();
            $text->user_id = $req->input('id');
            $text->message = $req->input('message');
            $text->save();

            return("Your message has been send!");
    }

    function all_text()
    {
        $texts = TextMessage::all();
        return view('admin.layout.sms.all_text', compact('texts'));
    }

    function send_bulk_text(Request $req)
    {
        $users = $req->all_option;
        $message = $req->input('message');
        $to = implode(',', $users);

        $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.sms.net.bd/sendsms',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'api_key' => '2dYuSnQNkQUUahkgg5f4EkMC414CIm0Kp7H0m1qH',
                    'msg' => $message." - Tutor Sheba",
                    'to' => $to,
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return back()->with('message', 'Your message has been send!');
    }
}


