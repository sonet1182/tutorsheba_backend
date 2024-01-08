@extends('admin.master')
@section('title', 'All user List | TutorSheba')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">User List</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admi2/new_student_request') }}">New Student Request</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/approval_student_list') }}">Approval Student List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/rejected_student_list') }}">Rejected student List</a></li>
        </ol>

    </div>
    <div class="page-content fade-in-up">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">User List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>E-Mail</th>
                            <th>Posted On</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allUser as $tutors)
                        <tr>
                            <td>
                                {{ $tutors->id }}
                            </td>
                            <td>{{ $tutors->name }}</td>
                            <td>{{ $tutors->phoneNumber }}</td>
                            <td>{{ $tutors->email }}</td>
                            <td>{{ date('d M, Y',strtotime($tutors->created_at)) }} At {{ date('g:ia',strtotime($tutors->created_at)) }}</td>

                            <td>
                                <a href="{{ url('/admin/user') }}/{{ $tutors->id }}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="make premium "><i class="fa fa-user-circle"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
