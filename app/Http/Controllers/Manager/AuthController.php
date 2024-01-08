<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('manager')->check()) {
            return redirect('/manager/dashboard');
        }
        return view('manager.auth.login');
    }

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect('/manager/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials. Please try again.']);
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
