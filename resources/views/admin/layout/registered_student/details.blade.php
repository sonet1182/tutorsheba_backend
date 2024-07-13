@extends('admin.master')

@section('title', 'Teacher Details | Admin')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Student/Guardian ID# {{ $student->id }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/new_teacher_request') }}">New Teacher Request</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/approval_teacher_list') }}">Approval Teacher List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/rejected_teacher_list') }}">Rejected Teacher List</a></li>
        </ol>
    </div>


    @if (session('teacherRequest'))
        <div class="alert alert-danger text-center">
            <h3 class="text-success">{{ session('teacherRequest') }}</h3>
        </div>
    @endif

    @if (\Session::has('message'))
        <div class="alert alert-success">
            {!! \Session::get('message') !!}
        </div>
    @endif

    <div class="page-content my-5">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Student/Guardian ID# {{ $student->teacher_id }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 " align="center"> <img alt="User Pic"
                                    src="{{ empty($student->image) ? asset('images/allUsers.jpg') : asset($student->image) }}"
                                    class="img-thumbnail img-responsive" style="width: 200px;height: 200px"
                                    onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/data/icons/instagram-ui-twotone/48/Paul-18-512.png';">
                            </div>
                            <div class="col-xs-12 col-md-8 col-lg-8 ">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td>Created Time :</td>
                                            <td><b>{{ date('d M, Y', strtotime($student->created_at)) }} At
                                                    {{ date('g:ia', strtotime($student->created_at)) }}</b></td>
                                        </tr>

                                        <tr>
                                            <td class="text-uppercase">Full Name :</td>
                                            <td>{{ $student->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase">Phone Number :</td>
                                            <td><b>{{ $student->phoneNumber }}</b></td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>




        <div class="card mt-5">
            <div class="card-header">
                <h3 class="text-center">Posted Jobs</h3>
            </div>
            <div class="card-body">

                @if($studentProfile->count() > 0)

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Manager</th>
                                <th>Note</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($studentProfile as $student)
                                <tr>
                                    <td>
                                        {{ $student->id }}
                                    </td>
                                    <td>{{ $student->s_fullName }} </td>
                                    <td>{{ $student->s_phoneNumber }}</td>
                                    <td style="width: 140px">
                                        {{ $student->districts ? $student->districts->districtName : '' }},
                                        {{ $student->s_area }} , {{ $student->s_address }}</td>
                                    <td>{{ $student->manager_info ? $student->manager_info->name : '' }}</td>

                                    <td>
                                        <!--<i class="fa fa-check text-success"></i>-->
                                        <b>{{ $student->note }}</b>
                                    </td>
                                    <td>{{ $student->created_at->format('h:i A | d M,Y') }}</td>
                                    <td style="width:120px">
                                        @if ($student->confirmed)
                                            <span class="badge badge-pill badge-success">Confirmed</span>
                                        @elseif($student->assigned->count() > 0)
                                            <span class="badge badge-pill badge-warning">Assigned</span>
                                        @else
                                            @if ($student->approval == 0)
                                                <span class="badge badge-pill badge-warning">Pending for verify</span>
                                            @elseif ($student->approval == 0)
                                                <span class="badge badge-pill badge-primary">Posted</span>
                                            @elseif ($student->approval == 4)
                                                <span class="badge badge-pill badge-info">On Hold</span>
                                            @elseif($student->approval == 5)
                                                <span class="badge badge-pill badge-dark">Cancel</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td style="width: 80px">
                                        <a href="{{ url('admin/student_details') }}{{ $student->id }}"
                                            class="btn btn-default btn-xs m-r-5" data-toggle="tooltip"
                                            data-original-title="Details"><i class="fa fa-info-circle font-14"></i></a>
                                        <a type="button" data-toggle="modal"
                                            data-target="#editModalAssign{{ $student->id }}" data-toggle="tooltip"
                                            data-original-title="Keep Note" title="Keep Note"
                                            class="btn btn-default btn-xs"><i class="fa fa-edit font-14"></i></a>


                                        <div class="modal fade" id="editModalAssign{{ $student->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ url('admin/approval_student_list/note/' . $student->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <h5 for="text-danger">Add Important Note:</h5>
                                                                <hr>

                                                                <textarea placeholder="Enter note..." class="form-control" name="note" rows="5" required>{{ $student->note }}</textarea>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-lg btn-outline-primary px-4">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>



                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <?php echo $studentProfile->links(); ?>
                </div>

                @else

                <div class="">
                    <h5 class="text-center py-5">-- No Data Found --</h5>
                </div>

                @endif


            </div>
        </div>




















    </div>
@endsection
