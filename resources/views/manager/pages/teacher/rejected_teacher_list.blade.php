@extends('manager.layouts.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Reject Teacher</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/manager/new_teacher_request') }}">New Request</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/manager/home_approval_teacher') }}">Home Approval</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/manager/approval_teacher_list') }}">Approval</a></li>
            <li class="breadcrumb-item active">Rejected</li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Picture</th>
                                    <th>Tutor Id</th>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>University</th>
                                    <th>Subject</th>
                                    <th>Ac</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teacherProfile as $teacher)
                                    <tr>
                                        <td>
                                            {{ $teacher->id }}
                                        </td>
                                        <td>
                                            <img src="{{ empty($teacher->teacher_profile_picture) ? asset('images/allUsers.jpg') : asset($teacher->teacher_profile_picture) }}" width="70" id="teacher_image">
                                            {{ $teacher->districtName }}
                                        </td>
                                        <td>
                                            {{ $teacher->teacher_id }}
                                        </td>
                                        <td>{{ $teacher->name }}</td>
                                        <td>
                                            <strong class="text-info">
                                                {{ $teacher->phoneNumber }}
                                            </strong>
                                        </td>
                                        <td>{{ $teacher->teacher_university }}</td>
                                        <td>{{ $teacher->teacher_subject }}</td>
                                        <td>{{ $teacher->approval }}</td>
                                        {{--<td>{{ date('d M, Y',strtotime($tutors->created_at)) }} At {{ date('g:ia',strtotime($tutors->created_at)) }}</td>--}}

                                        <td>
                                            <a href="{{ url('manager/teacher_details') }}{{ $teacher->id }}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit font-20"></i></a>
                                            <button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-20"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
