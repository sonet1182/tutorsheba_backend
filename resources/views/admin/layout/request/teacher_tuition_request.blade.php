@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Teacher Tuition Request</h1>
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
                                <th>S ID</th>
                                <th>S Name</th>
                                <th>S phone</th>
                                <th>T Name</th>
                                <th>T Phone</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tuitionRequest as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->student_id }}</td>
                                    <td>{{ $value->student && $value->student->s_fullName }}</td>
                                    <td>{{ $value->student && $value->student->s_phoneNumber }}</td>
                                    <td>{{ $value->teacher ? $value->teacher->name : '' }}</td>
                                    <td>{{ $value->teacher ? $value->teacher->phoneNumber : '' }}</td>
                                    <td>
                                        <a href="{{ url('/admin/request-details') }}/{{ $value->id }}" title="View" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="{{ url('/admin/request-details') }}" title="View" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <?php echo $tuitionRequest->links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
