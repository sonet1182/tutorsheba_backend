@extends('manager.layouts.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Profile Verification Request</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile Verification Request</li>
            </ol>
        </nav>
    </div>


    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-12">
                <div class="ibox">
                    <div class="ibox-body table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                            <tr>
                                <th>Teacher ID#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Profile Verification</th>
                                <th>Time</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tutorRequest as $value)
                                <tr>
                                    <td>{{ $value->user_id }}</td>
                                    <td>{{ $value->user ? $value->user->name : '' }}</td>
                                    <td>{{ $value->user ? $value->user->phoneNumber : '' }}</td>
                                    <td>
                                        @if($value->user && $value->user->verified == 1)
                                            <span class="badge badge-pill badge-success">Verified</span>
                                        @else
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->created_at->format('h:i:s || d-M-Y') }}</td>
                                    <td>
                                        <a href="{{ url('/admin/teacher_details'.$value->user_id) }}" title="View" class="btn btn-info btn-xs px-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
@endsection
