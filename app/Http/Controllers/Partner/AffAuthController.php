<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\AllMedium;
use App\Models\Partner;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AffAuthController extends Controller
{

    public function info(Request $request)
    {
        $data = Partner::where('id', $request->user()->id)->first();

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'Welcome to your Uddokta profile'
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required_if:user_type,"tutor"|unique:partners,email',
            'phone' => 'required|unique:partners,phoneNumber',
            'password' => 'required|min:4',
            // 'present_address' => 'required',
            // 'district' => 'required',
            // 'areas' => 'required',
            // 'gender' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = Partner::create([
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->phone,
                'area' => $request->area,
                'district' => $request->district,
                'gender' => $request->gender,
                'ref_id' => date("Ymd") . rand(1111, 9999),
                'password' => Hash::make($request->password),
                'otp' => rand(100000, 999999)
            ]);

            $token = $user->createToken($user->phoneNumber . '_Token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'api_token' => $token,
                'data' => $user,
                'user_type' => 'partner',
                'notification' => 0,
                'message' => 'You have registered as a Uddokta Successfully',
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
            $user = Partner::where([['email', $request->email]])->orWhere([['phoneNumber', $request->email]])->first();

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
                    'user_type' => 'partner',
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
            $user = Partner::find($request->user()->id);

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
            $user = Partner::find($request->user()->id);

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

    public function lead_generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            's_fullName' => 'required',
            's_phoneNumber' => 'required|regex:/(01)[0-9]{9}/',
            's_districts' => 'required',
            's_area' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 204,
                'message' => $validator->errors(),
            ]);
        } else {
            $student = new StudentProfile();
            $student->title = 'Tutor Request From Active Lead Generation';
            $student->s_fullName = $request->s_fullName;
            $student->s_phoneNumber = $request->s_phoneNumber;
            //   $student->s_email = $request->s_email;
            $student->s_gender = $request->s_gender;
            $student->s_college = $request->s_college;
            $student->s_class = $request->s_class;
            $student->s_medium = AllMedium::find($request->s_medium)->mediumName;
            $student->s_districts = $request->s_districts;
            $student->s_area = $request->s_area;
            $student->s_address = $request->s_address;
            $student->t_gender = $request->t_gender;
            $student->t_subject = '';
            $student->t_days = $request->t_days;
            $student->t_salary = $request->t_salary;
            $student->ex_information = $request->ex_information;

            $student->lead_generator = $request->user()->id;
            $student->lead_type = 0;

            $student->save();

            return response()->json([
                'status' => 200,
                'message' => 'Thank yor for requesting | your request successfully saved,',
            ]);
        }
    }


    public function lead_list(Request $request, $limit)
    {
        $studentinfo = StudentProfile::with('districts', 'confirmed', 'assigned', 'txn')
            ->where('lead_generator', $request->user()->id)
            ->orderBy('id', 'desc')
            ->paginate($limit);

        return response()->json([
            'status' => 200,
            'data' => $studentinfo,
        ]);
    }

    public function update_profile_photo(Request $request)
    {
        $teacher = Partner::where('id', $request->user()->id)->first();

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
                Partner::where('id', $request->user()->id)->update([
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
