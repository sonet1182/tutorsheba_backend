<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class AuthController extends Controller
{

    public function info(Request $request)
    {
        $data = Student::find($request->user()->id);

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'Welcome to your Student profile'
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:students,phoneNumber',
            'password' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = Student::create([
                'name' => $request->name,
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
                'notification' => 0,
                'message' => 'You have registered as a Student Successfully',
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
            $user = Student::where([['email', $request->email]])->orWhere([['phoneNumber', $request->email]])->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid Credantials',
                    'data' => $request->email,
                ]);
            } else {

                if ($user->status != 1) {
                    return response()->json([
                        'status' => 401,
                        'message' => 'Your account has been blocked! Please contact with authority.',
                        'data' => $request->email,
                    ]);
                }

                $token = $user->createToken($user->email . '_Token')->plainTextToken;

                return response()->json([
                    'status' => 200,
                    'api_token' => $token,
                    'data' => $user,
                    'notification' => 0,
                    'user_type' => 'student',
                    'message' => 'Logged In Successfully',
                ]);
            }
        }
    }

    public function user_info_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = Student::find($request->user()->id);

            $user->name = $request->name;
            $user->agent_type = $request->type;
            $user->area = $request->area;
            $user->district = $request->district;
            $user->org_name = $request->org_name;
            $user->org_address = $request->org_address;
            $user->update();

            return response()->json([
                'status' => 200,
                'data' => $user,
                'message' => 'Account Info Updated Successfully',
            ]);
        }
    }

    public function user_acc_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_type' => 'required',
            'acc_number' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = Student::find($request->user()->id);

            $user->bank_type = $request->bank_type;
            $user->acc_number = $request->acc_number;
            $user->update();

            return response()->json([
                'status' => 200,
                'data' => $user,
                'message' => 'Payment Credential Info Updated Successfully',
            ]);
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



    public function update_profile_photo(Request $request)
    {
        $teacher = Student::where('id', $request->user()->id)->first();

        if ($request->image) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            ]);

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = 'images/partner/';
            $img = Image::make($image->getRealPath());
            $img->resize(220, 220)->save($path . $imageName);
            $image->move($path, $image);
            $imageUrl = $path . $imageName;
            $filenamedelate = basename($image);
            unlink($path . $filenamedelate);
            if (file_exists($teacher->profile_picture)) {
                unlink($teacher->profile_picture);
            }
            if (isset($imageUrl)) {
                Student::where('id', $request->user()->id)->update([
                    'profile_picture' => $imageUrl,
                ]);
            }
        }

        $teacher->save();

        return response()->json([
            'status' => 200,
            'data' => $teacher,
            'notification' => 0,
            'user_type' => 'partner',
            'message' => 'Profile Photo has Updated Successfully'
        ]);
    }
}
