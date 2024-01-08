<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\TeacherProfile;
use App\Models\TextMessage;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        if ($request->user_type == 'tutor') {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required_if:user_type,"tutor"|unique:users,email',
                'phone' => 'required|unique:users,phoneNumber',
                'password' => 'required|min:4',
                'present_address' => 'required',
                'district' => 'required',
                'areas' => 'required',
                'gender' => 'required',
            ]);
        } elseif ($request->user_type == 'student') {
            $validator = Validator::make($request->all(), [
                'phone' => 'required|unique:students,phoneNumber',
                'password' => 'required|min:4'
            ]);
        }


        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            if ($request->user_type == 'tutor') {
                $collection = collect($request->areas);
                $output = $collection->implode('value', ', ');

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phoneNumber' => $request->phone,
                    'password' => Hash::make($request->password),
                    'otp' => rand(100000, 999999)
                ]);

                $tutor = new TeacherProfile();
                $tutor->user_id = $user->id;
                $tutor->teacher_id = 'TS-' . $user->id;
                $tutor->district_id = $request->district;
                $tutor->tuition_area = $output;
                $tutor->teacher_gender = $request->gender;
                $tutor->teacher_present_city = $request->present_city;
                $tutor->teacher_present_address = $request->present_address;
                $tutor->prog = 10;
                $tutor->save();

                $token = $user->createToken($user->email . '_Token')->plainTextToken;

                $notification = TextMessage::where('user_id', $user->id)->where('status', 0)->count();

                return response()->json([
                    'status' => 200,
                    'api_token' => $token,
                    'data' => $user,
                    'notification' => $notification,
                    'user_type' => 'tutor',
                    'message' => 'You have registered as a Tutor Successfully',
                ]);
            } elseif ($request->user_type == 'student') {
                $user = Student::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phoneNumber' => $request->phone,
                    'password' => Hash::make($request->password),
                    'otp' => rand(100000, 999999)
                ]);

                $token = $user->createToken($user->phoneNumber . '_Token')->plainTextToken;

                return response()->json([
                    'status' => 200,
                    'api_token' => $token,
                    'data' => $user,
                    'user_type' => 'student',
                    'message' => 'You have registered as a Student Successfully',
                ]);
            }
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:4'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = User::with('teacher', 'verification')->where([['email', $request->email]])->orWhere([['phoneNumber', $request->email]])->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid Credantials',
                ]);
            } else {
                $token = $user->createToken($user->email . '_Token')->plainTextToken;
                $notification = TextMessage::where('user_id', $user->id)->where('status', 0)->count();

                return response()->json([
                    'status' => 200,
                    'api_token' => $token,
                    'data' => $user,
                    'user_type' => "tutor",
                    'notification' => $notification,
                    'message' => 'Logged In Successfully',
                ]);
            }
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            // $request->user()->currentAccessToken()->delete();
            $this->apiSuccess('Logout Successfully');
            return $this->apiOutput();
        } catch (\Throwable $e) {
            return $this->getError($e);
        }
    }

    public function reset_password_req(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = User::where([['phoneNumber', $request->phone]])->first();

            if (!$user) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid Credantials',
                ]);
            } else {
                $user->otp = rand(1000, 9999);
                $user->update();
                $message = "To recover your password use this otp: " . $user->otp . " - Tutor Sheba";

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.sms.net.bd/sendsms',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'api_key' => '2dYuSnQNkQUUahkgg5f4EkMC414CIm0Kp7H0m1qH',
                        'msg' => $message,
                        'to' => $user->phoneNumber
                    ),
                ));
                $response = curl_exec($curl);

                curl_close($curl);


                return response()->json([
                    'status' => 200,
                    'data' => $user,
                    'message' => 'OTP has been send to -' . $user->phoneNumber,
                ]);
            }
        }
    }


    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = User::with('teacher', 'verification')->orWhere([['phoneNumber', $request->phone]])->first();
            $user->password = Hash::make($request->password);
            $user->update();

            $notification = TextMessage::where('user_id', $user->id)->where('status', 0)->count();

            $token = $user->createToken($user->email . '_Token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'api_token' => $token,
                'data' => $user,
                'notification' => $notification,
                'message' => 'Logged In Successfully',
            ]);
        }
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = User::find(auth('sanctum')->user()->id);

            if (Hash::check($request->old_password  , $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Password Updated Successfully!',
                ]);
            }else{
                return response()->json([
                    'status' => 202,
                    'message' => 'Yor OLd Password is Incorrect!',
                ]);
            }
        }
    }
}
