<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Http\Request;

class LogoutController extends Controller
{

    public function logoutPage()
    {
        $admins = Admin::where('logged_in', 1)->get();
        $managers = Manager::where('logged_in', 1)->get();

        return view('admin.layout.logoutPage.index', compact('admins', 'managers'));
    }

    public function logoutAllAdmins()
    {
        $adminUsers = Admin::all();

        foreach ($adminUsers as $user) {
            $user->update(['logged_in' => 0]);
            $user->tokens()->delete();
        }
        return redirect('/admin/login');
    }

    public function logoutAllManagers()
    {
        $managerUsers = Manager::all();

        foreach ($managerUsers as $user) {
            $user->update(['logged_in' => 0]);
            $user->tokens()->delete();
        }

        return back()->with('message', 'All Managers has been logged out from all devices.');
    }

    public function logoutAdmin($id)
    {
        $user = Admin::find($id);
        $user->update(['logged_in' => 0]);
        $user->tokens()->delete();

        return back()->with('message', 'Selected Admin has been logged out from all devices.');
    }

    public function logoutManager($id)
    {
        $user = Manager::find($id);
        $user->update(['logged_in' => 0]);
        $user->tokens()->delete();

        return back()->with('message', 'Selected Manager has been logged out from all devices.');
    }
}
