<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('manager')->check() && Auth::guard('manager')->user()->logged_in == 1) {
            return redirect('/manager/dashboard');
        }

        return view('manager.auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $user = Auth::guard('manager')->user();

            $user->update([
                'logged_in' => 1,
                'last_sign_in_at' => Carbon::now(),
            ]);

            $trustedIps = config('custom.trusted_ips');
            $userIp = $request->ip();

            if (!in_array($userIp, $trustedIps)) {
                $message = 'Login attempt in Manager Panel from ' . $userIp . ' - Tutor Sheba';
                $this->sendTextNotification($message);
            }
            return redirect('/manager/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials. Please try again.']);
    }

    public function sendTextNotification($message)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sms.net.bd/sendsms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'api_key' => '2dYuSnQNkQUUahkgg5f4EkMC414CIm0Kp7H0m1qH',
                'msg' => $message,
                'to' => '01722575388',
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
    }









    public function destroy(Request $request)
    {
        Auth::guard('manager')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/manager/login');
    }


    public function reset_pass_view()
    {
        return view('manager.auth.reset_password');
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required|same:new_password',
        ]);

        if (!Hash::check($request->old_password, Auth::guard('manager')->user()->password)) {
            return back()->with('error', 'The old password is incorrect.');
        }

        $user = Auth::guard('manager')->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('message', 'Password updated successfully.');
    }
}
