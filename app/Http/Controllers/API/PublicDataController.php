<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AllArea;
use App\Models\AllDistrict;
use App\Models\AllMedium;
use App\Models\AnyClass;
use App\Models\AnySubject;
use App\Models\SliderImg;
use Illuminate\Http\Request;

class PublicDataController extends Controller
{
    //
    public function banner()
    {
        $banners = SliderImg::where('activity', 1)->get();

        return response()->json([
            'status' => 200,
            'banners' => $banners,
        ]);
    }

    public function arealist($district_id)
    {
        $data = AllArea::where('district_id', $district_id)
            ->orderBy('areaName', 'asc')
            ->get();
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
    public function classlist($medium_id)
    {
        $data = AnyClass::where('medium_id', $medium_id)
            ->orderBy('className', 'asc')
            ->get();
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
    public function subjectlist($class_id)
    {
        $data = AnySubject::where('class_id', $class_id)
            ->orderBy('subjectName', 'asc')
            ->get();
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
    public function allDistrict()
    {
        $data = AllDistrict::all();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
    public function allMedium()
    {
        $data = AllMedium::all();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
}
