<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');
        }
        return view('auth.Admin.login');
    }

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect('/admin/dashboard');
        }
        return back()->withErrors(['email' => 'Invalid credentials. Please try again.']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function reset_pass_view()
    {
        return view('admin.layout.auth.reset_password');
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required|same:new_password',
        ]);

        if (!Hash::check($request->old_password, Auth::guard('admin')->user()->password)) {
            return back()->with('error', 'The old password is incorrect.');
        }

        $user = Auth::guard('admin')->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('message', 'Password updated successfully.');
    }
}
