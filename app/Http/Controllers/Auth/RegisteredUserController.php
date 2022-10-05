<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AllDistrict;
use App\Models\TeacherProfile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Intervention\Image\ImageManagerStatic as Image;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $allDistrict = AllDistrict::all();
        return view('auth.register',compact('allDistrict'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phoneNumber' => ['required','unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // =====teacher table use id pass=========
        $id = 'TS-'.Auth::user()->id;

        if (Auth::user()){
            $tutor = new TeacherProfile();
            $tutor->user_id = Auth::user()->id;
            $tutor->teacher_id = $id;

            $tutor->district_id = $request->district_id;
            $tutor->tuition_area = $request->tuition_area ? implode(", ", $request->tuition_area) : '';
            $tutor->teacher_name = $request->teacher_name;
            $tutor->a_phone_number = $request->a_phone_number;
            $tutor->teacher_gender = $request->teacher_gender;

            $tutor->save();
        }else{
            return back();
        }


        // =====teacher table use id pass=========

        // return $this->registered($request, $user)
        //     ?: redirect('message','Your Registration has been Successfull. Please wait for confirmation !');

        // return redirect(RouteServiceProvider::HOME);

        return Redirect('/tutor/dashboard')->with('message','Your Registration has been Successfull!');
    }
}
