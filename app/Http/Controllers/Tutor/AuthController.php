<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'email' => 'required|unique:users,email|email:rfc,dns|email',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phoneNumber',
            'password' => 'required|min:4'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->phone,
                'password' => Hash::make($request->password),
                'otp' => rand(100000, 999999)
            ]);

            $token = $user->createToken($user->email . '_Token')->plainTextToken;


            return response()->json([
                'status' => 200,
                'token' => $token,
                'user' => $user,
                'message' => 'You have registered Successfully',
            ]);
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
            $user = User::where([['email', $request->email]])->orWhere([['phoneNumber', $request->email]])->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid Credantials',
                ]);
            } else {
                $token = $user->createToken($user->email . '_Token')->plainTextToken;

                return response()->json([
                    'status' => 200,
                    'api_token' => $token,
                    'data' => $user,
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

    // public function logout(){
    //     auth()->user('sanctum')->tokens()->delete();

    //     return response()->json([
    //         'status' => 200,
    //         'message' => 'Logged Out Successfully',
    //         'user' => auth('sanctum')->user(),
    //     ]);
    // }
}
