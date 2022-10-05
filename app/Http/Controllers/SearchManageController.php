<?php

namespace App\Http\Controllers;

use App\Models\AllArea;
use App\Models\AllMedium;
use App\Models\AnyClass;
use App\Models\AnySubject;
use App\Models\University;
use App\Models\VisitCount;
use Illuminate\Http\Request;

class SearchManageController extends Controller
{
    public function arealist(Request $request){
        $data = AllArea::where('district_id',$request->id)
            ->orderBy('areaName','asc')
            ->get();
        return response()->json($data);
}
public function classlist(Request $request){
   $dataMedium = AllMedium::where('mediumName',$request->mname)->first();
   $dataEmty = isset($dataMedium->id) ? $dataMedium->id : null;
   $data = AnyClass::where('medium_id',$dataEmty)
       ->orderBy('className','asc')
       ->get();
   return response()->json($data);
}
public function subjectlist(Request $request){
   $dataClass = AnyClass::where('className',$request->cname)->first();
   $dataEmty = isset($dataClass->id) ? $dataClass->id : null;
   $data = AnySubject::where('class_id',$dataEmty)
       ->orderBy('subjectName','asc')
       ->get();
   return response()->json($data);
}
public function teacherVisitCount(Request $request){
    VisitCount::where('tutor_id', $request->id)->update([
        'visit_count' => $request->visit
    ]);
}

public function university()
{
   $university = University::all();
   return response()->json($university);
}
}
