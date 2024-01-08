@extends('admin.master')

@section('title','Reject Tuition List | Admin')

@section('content')


    <div class="page-heading">
        <h1 class="page-title">Reject Tuition</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/new_student_request') }}">New Request</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/approval_student_list') }}">Approval</a></li>
            <li class="breadcrumb-item active">Rejected</li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>School</th>
                                    <th>Address</th>
                                    <th>Activity</th>
                                    <th>Time</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($studentProfile as $student)
                                    <tr>
                                        <td>
                                            {{ $student->id }}
                                        </td>
                                        <td>{{ $student->s_fullName }}</td>
                                        <td>{{ $student->s_phoneNumber }}</td>
                                        <td>{{ $student->s_college }} / {{ $student->t_subject }}</td>
                                        <td>{{ $student->districtName }} , {{ $student->s_area }} , {{ $student->s_address }}</td>
                                        <td><i class="fa fa-deaf text-danger"></i></td>
                                        <td>{{ $student->created_at }}</td>
                                        <td>
                                            <a href="{{ url('admin/student_details') }}{{ $student->id }}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Details"><i class="fa fa-edit font-14"></i></a>
                                            <button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <?php echo $studentProfile->links(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
