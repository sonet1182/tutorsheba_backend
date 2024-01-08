@extends('admin.master')

@section('title','All Texts List | Admin')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">All Text List</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Teacher Tuition Request</li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/student_tutor_request') }}">Student Tutor Request</a></li>
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
                                <th>ID#</th>
                                <th>User ID</th>
                                <th>Mesaage</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($texts as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->user_id }}</td>
                                    <td>{{ $value->message }}</td>
                                    <td>{{ $value->created_at }}</td>
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
