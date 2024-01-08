@extends('manager.layouts.master')



@section('title', 'New Tuition Request | Manager')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">New Tuition Request</h1>
        <ol class="breadcrumb">
manager/dashboard            <li class="breadcrumb-item active">New Request</li>
            <li class="breadcrumb-item"><a href="{{ url('/manager/approval_student_list') }}">Approval</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/manager/rejected_student_list') }}">Rejected</a></li>
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
                                        <th>Manager</th>
                                        <th>Activity</th>
                                        <th>Time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentProfile as $student)
                                        <tr>
                                            <td>
                                                {{ $student->id }}
                                            </td>
                                            <td>{{ $student->s_fullName }}
                                                @if ($student->partner)
                                                    <br><span class="badge badge-pill badge-info">{{ $student->partner->name }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $student->s_phoneNumber }}</td>
                                            <td>{{ $student->s_college }} / {{ $student->t_subject }}</td>
                                            <td>{{ $student->s_address && $student->s_address . ', ' }}{{ $student->s_area }},
                                                {{ $student->districts ? $student->districts->districtName : '' }}</td>
                                            <td>{{ $student->manager_info ? $student->manager_info->name : '' }}</td>
                                            <td><i class="fa fa-warning text-warning"></i></td>
                                            <td>
                                            {{ \Carbon\Carbon::parse($student->created_at)->format('h:i a \| d M, Y') }}
                                            </td>
                                            <td>
                                                <a href="{{ url('manager/student_details') }}{{ $student->id }}"
                                                    class="btn btn-default btn-xs m-r-5" data-toggle="tooltip"
                                                    data-original-title="Details"><i class="fa fa-edit font-14"></i></a>
                                                <button class="btn btn-default btn-xs" data-toggle="tooltip"
                                                    data-original-title="Delete"><i
                                                        class="fa fa-trash font-14"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <?php echo $studentProfile->links(); ?> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
