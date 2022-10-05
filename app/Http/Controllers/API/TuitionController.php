<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TuitionController extends Controller
{
    public function tuition_list($limit)
    {
        $data = StudentProfile::with('districts')
            ->where('approval', 1)->latest()->paginate($limit);
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }

    public function tuitionView($id) {

        $tuition = StudentProfile::where('id',$id)->first();

        return response()->json([
            'status' => 200,
            'tuition' => $tuition,
        ]);
    }
}
