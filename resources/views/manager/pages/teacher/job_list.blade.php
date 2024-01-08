@extends('manager.layouts.master')

@section('title','Approval Tuition | manager')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">{{ $status }} Tuition List</h1>
        <!--<ol class="breadcrumb">-->
        <!--    <li class="breadcrumb-item"><a href="{{ url('/manager') }}"><i class="icon-home2 position-left"></i> Home</a></li>-->
        <!--    <li class="breadcrumb-item"><a href="{{ url('/manager/new_student_request') }}">New Request</a></li>-->
        <!--    <li class="breadcrumb-item active">Approval</li>-->
        <!--    <li class="breadcrumb-item"><a href="{{ url('/manager/rejected_student_list') }}">Rejectet</a></li>-->
        <!--</ol>-->
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>By</th>
                                    <th>Remark</th>
                                    <th>Status</th>
                                    <th>Activity</th>
                                    <th>Time</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($studentinfo as $studentinfo)

                                <tr>
                                        <td>
                                            {{ $studentinfo->id }}
                                        </td>
                                        <td>{{ $studentinfo->student->s_fullName }}</td>
                                        <td>{{ $studentinfo->student->s_phoneNumber }}</td>

                                        <td>
                                            {{ $studentinfo->assigned_by ? $studentinfo->assigned_by : '' }}
                                            {{ $studentinfo->confirmed_by ? $studentinfo->confirmed_by : '' }}
                                            {{ $studentinfo->rejected_by ? $studentinfo->rejected_by : '' }}
                                        </td>

                                        <td>{{ $studentinfo->remark ? $studentinfo->remark : $studentinfo->reason }}</td>
                                        <td style="width:120px">
                                            @if($studentinfo->student->confirmed)
                                                <span class="badge badge-pill badge-success">Confirmed</span>
                                            @elseif($studentinfo->student->assigned->count() > 0)
                                                <span class="badge badge-pill badge-warning">Assigned</span>
                                            @endif
                                        </td>
                                        <td><i class="fa fa-check text-success"></i></td>
                                        <td>{{$studentinfo->created_at }}</td>
                                        <td style="width: 80px">
                                            <a href="{{ url('manager/student_details') }}{{ $studentinfo->student->id }}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Details"><i class="fa fa-edit font-14"></i></a>
                                            <!--<button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>-->
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
