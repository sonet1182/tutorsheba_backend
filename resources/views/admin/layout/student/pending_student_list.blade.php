@extends('admin.master')

@section('title', 'Pending Tuition | Admin')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Pending Tuition</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/new_student_request') }}">New Request</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/approval_student_list') }}">Approved</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/rejected_student_list') }}">Rejected</a></li>
            <li class="breadcrumb-item active">Pending</li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/cancelled_student_list') }}">Cancelled</a></li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-md-6">

                            <form action="{{ url('admin/tuition_search_by_id') }}" method="POST" class="row">
                                @csrf
                                <input type="text" class="form-control col-8" name="job_id" placeholder="ID..." />
                                <button class="btn btn-primary col-4" type="submit">By Id</button>
                            </form>


                        </div>
                        <div class="col-md-6">
                            <form action="{{ url('admin/tuition_search_by_phone') }}" method="POST" class="row">
                                @csrf
                                <input type="text" class="form-control col-8" name="phone" placeholder="Phone...." />
                                <button class="btn btn-primary col-4" type="submit">By Phone</button>
                            </form>
                        </div>
                        <!--<div class="col-md-4">-->
                        <!--                <select class="form-control col-12" name="manager" onchange="location = this.value;">-->
                        <!--                <option value="{{ url('admin/approval_student_list') }}">All</option>-->
                        <!--                @foreach ($manager_list as $managert)
    -->

                        <!--                    <option value="{{ url('admin/approval_student_list/by_manager/' . $managert->id) }}" {{ $manager == $managert->id ? 'selected' : '' }} >{{ $managert->name }}</option>-->
                        <!--
    @endforeach-->
                        <!--            </select>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
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
                                        <th>Address</th>
                                        <th>Manager</th>
                                        <th>Status</th>
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
                                                    <br><span
                                                        class="badge badge-pill badge-info">{{ $student->partner->name }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $student->s_phoneNumber }}</td>
                                            <td style="width: 140px">
                                                {{ $student->districts ? $student->districts->districtName : '' }},
                                                {{ $student->s_area }} , {{ $student->s_address }}</td>
                                            <td>{{ $student->manager_info ? $student->manager_info->name : '' }}</td>
                                            <td style="width:120px">
                                                <span class="badge badge-pill badge-warning">Pending</span>
                                            </td>
                                            <td><i class="fa fa-check text-success"></i></td>
                                            <td>{{ $student->created_at->format('h:i A | d M,Y') }}</td>
                                            <td style="width: 80px">
                                                <a href="{{ url('admin/student_details') }}{{ $student->id }}"
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
                            <?php echo $studentProfile->links(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    $("select").click(function() {
    var open = $(this).data("isopen");
    if(open) {
    window.location.href = $(this).val()
    }
    //set isopen to opposite so next time when use clicked select box
    //it wont trigger this event
    $(this).data("isopen", !open);
    });
@endsection
