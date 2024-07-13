<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AllArea;
use App\Models\AllMedium;
use App\Models\AnyClass;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Models\TuitionRequest;
use Illuminate\Http\Request;

class TuitionController extends Controller
{
    public function tuition_list(Request $request, $limit)
    {
        $id = $request->id;
        $districts = $request->district;
        $tuition_area = $request->area ? AllArea::find($request->area)->areaName : null;
        $tuition_medium = $request->medium ? AllMedium::find($request->medium)->mediumName : null;
        $tuition_class = $request->class ? AnyClass::find($request->class)->className : null;
        $tuition_subject = $request->subject;
        $teacher_gender = $request->gender;
        $tutoring_type = $request->type;
        $start = $request->start;
        $end = $request->end;

        $query = StudentProfile::with('districts', 'assigned')
            ->select(
                'student_profile.id as id',
                'student_profile.s_districts as s_districts',
                'student_profile.s_area as s_area',
                'student_profile.title as title',
                'student_profile.tutoring_type as tutoring_type',
                'student_profile.created_at as created_at',
                'student_profile.s_medium as s_medium',
                'student_profile.s_class as s_class',
                'student_profile.t_subject as t_subject',
                'student_profile.t_gender as t_gender',
                'student_profile.s_medium as s_medium',
                'student_profile.t_salary as t_salary',
                'student_profile.s_number as s_number',
                'student_profile.t_days as t_days',
                'student_profile.ex_information as ex_information',
                'student_profile.approval as approval',
                'student_profile.created_at as created_at',
            )
            ->where('approval', 1);

        if (!empty($id)) {
            $query->where('id', 'like', '%' . $id . '%');
        }

        if (!empty($districts)) {
            $query->where('s_districts', $districts);
        }

        if (!empty($tuition_area)) {
            $query->where('s_area', $tuition_area);
        }

        if (!empty($tuition_medium)) {
            $query->where('s_medium', $tuition_medium);
        }

        if (!empty($tuition_class)) {
            $query->where('s_class', $tuition_class);
        }

        if (!empty($tuition_subject)) {
            $query->where('s_subject', $tuition_subject);
        }

        if (!empty($teacher_gender)) {
            $query->where('t_gender', $teacher_gender);
        }

        if (!empty($tutoring_type)) {
            $query->where('tutoring_type', '=', $tutoring_type);
        }

        if (!empty($start)) {
            $query->whereDate('created_at', '>=', $start);
            if (!empty($end)) {
                $query->whereDate('created_at', '<=', $end);
            }
        } elseif (!empty($end)) {
            // If only end date is provided, fetch data up to the end date
            $query->whereDate('created_at', '<=', $end);
        }

        $alltuitions = $query->latest()->paginate($limit);

        return response()->json([
            'status' => 200,
            'data' => $alltuitions,
        ]);
    }


    public function tuitionView($id)
    {

        if (auth('sanctum')->user()) {
            $teacher = TeacherProfile::where('user_id', auth('sanctum')->user()->id)->first();
            if ($teacher)
                $prog = $teacher->prog;
            else
                $prog = 0;

            $tuition_request = TuitionRequest::where('user_id', auth('sanctum')->user()->id)->where('student_id', $id)->first();
        } else {
            $prog = null;
            $tuition_request = null;
        }

        $tuition = StudentProfile::where('id', $id)
            ->select(
                'student_profile.id as id',
                'student_profile.s_districts as s_districts',
                'student_profile.s_area as s_area',
                'student_profile.title as title',
                'student_profile.tutoring_type as tutoring_type',
                'student_profile.created_at as created_at',
                'student_profile.s_medium as s_medium',
                'student_profile.s_class as s_class',
                'student_profile.t_subject as t_subject',
                'student_profile.s_medium as s_medium',
                'student_profile.t_salary as t_salary',
                'student_profile.ex_information as ex_information',
                'student_profile.approval as approval',
                'student_profile.s_gender as s_gender',
                'student_profile.t_gender as t_gender',
                'student_profile.s_number as s_number',
                'student_profile.time as time',
                'student_profile.time_duration as time_duration',
                'student_profile.t_days as t_days'
            )->with('districts', 'assigned')->first();

        return response()->json([
            'status' => 200,
            'data' => $tuition,
            'acc_progress' => $prog,
            'tuition_request' => $tuition_request,
        ]);
    }

    public function job_board($limit)
    {
        $quary = StudentProfile::with('districts')
            ->where('approval', 1);

        $alltuitions = $quary->latest()->paginate($limit);

        $teacher = TeacherProfile::where('user_id', auth('sanctum')->user()->id)->first();

        $tuition_area = $teacher->tuition_area;

        $tuitionAreas = explode(', ', $tuition_area);

        // Define an array to store the matched data
        $matchedData = [];

        // Loop through each value in the array and search for matching data in the other table
        foreach ($tuitionAreas as $area) {
            $data = StudentProfile::with('districts', 'assigned')
                ->where('s_area', 'like', $area)
                ->where('approval', 1)
                ->where(function ($query) {
                    $query->where('approval', '!=', 5)
                        ->whereDoesntHave('assigned');
                })
                ->select(
                    'student_profile.id as id',
                    'student_profile.s_districts as s_districts',
                    'student_profile.s_area as s_area',
                    'student_profile.title as title',
                    'student_profile.tutoring_type as tutoring_type',
                    'student_profile.created_at as created_at',
                    'student_profile.s_medium as s_medium',
                    'student_profile.s_class as s_class',
                    'student_profile.t_subject as t_subject',
                    'student_profile.s_medium as s_medium',
                    'student_profile.t_salary as t_salary',
                    'student_profile.t_days as t_days',
                    'student_profile.ex_information as ex_information',
                    'student_profile.approval as approval'
                )
                ->latest()
                ->get();



            if (!empty($data)) {
                $matchedData[] = $data;
            }
        }

        // Combine all the arrays in $matchedData into a single array
        $combinedData = collect();
        foreach ($matchedData as $data) {
            $combinedData = $combinedData->merge($data);
        }


        // Paginate the combined data
        $perPage = 10; // Set the number of items per page
        $page = request('page', 1); // Get the current page from the query string parameter 'page'
        $offset = ($page - 1) * $perPage; // Calculate the offset
        // $paginatedData = $combinedData->slice($offset, $perPage)->all();
        $paginatedData = $combinedData->slice($offset, $perPage)->values()->all();
        $total = $combinedData->count(); // Get the total number of items


        // Calculate the total number of pages
        $totalPages = ceil($total / $perPage);

        // Generate an array of page links
        $pageLinks = [];
        for ($i = 1; $i <= $totalPages; $i++) {
            $pageLinks[] = [
                'url' => url('/api/job-board?page=' . $i),
                'label' => $i,
                'active' => ($i == $page),
            ];
        }

        // Create the pagination result as an array
        $result = [
            'data' => $paginatedData,
            'from' => 1,
            'to' => 10,
            'current_page' => (int)$page,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => $totalPages,
            'first_page_url' => url('/api/job-board?page=1'),
            'last_page_url' => url('/api/job-board?page=' . $totalPages),
            'next_page_url' => ($page < $totalPages) ? url('/api/job-board?page=' . ($page + 1)) : null,
            'prev_page_url' => ($page > 1) ? url('/api/job-board?page=' . ($page - 1)) : null,
            'links' => $pageLinks,
        ];


        return response()->json([
            'status' => 200,
            'data' => $result,
            'tuition_area' => $tuition_area,
            'matched' => $alltuitions,
        ]);
    }
}
