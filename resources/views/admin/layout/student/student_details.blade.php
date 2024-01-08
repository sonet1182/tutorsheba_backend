@extends('admin.master')

@section('title')
    ID# 01000{{ $studentDetails->id }} Tuition Details | Admin
@stop

@section('content')
    <div class="page-heading">
        <h1 class="page-title">ID# 01000{{ $studentDetails->id }} <strong>Student Information</strong></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/new_student_requestr') }}">New Student Request</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/approval_student_list') }}">Approval Student List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/rejected_situdent_list') }}">Rejected student List</a>
            </li>
        </ol>
    </div>


    @if (session('app'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{ session('app') }}.
        </div>
    @endif
    @if (session('rej'))
        <div class="alert alert-danger">
            <strong>Danger!</strong> {{ session('rej') }}.
        </div>
    @endif
    @if (\Session::has('status'))
        <div class="alert alert-success">
            {!! \Session::get('status') !!}
        </div>
    @endif

    <div class="page-content my-5">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">ID# 01000{{ $studentDetails->id }} <strong>Student Information</strong>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-uppercase">request time :</td>
                                    <td><b>{{ date('d M, Y', strtotime($studentDetails->created_at)) }} At
                                            {{ date('g:ia', strtotime($studentDetails->created_at)) }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Approval :</td>
                                    <td>
                                        @if ($studentDetails->approval == 1)
                                            <span class="btn btn-sm btn-success">
                                                Approved
                                            </span>
                                        @else
                                            <span class="btn btn-sm btn-warning">
                                                Pending
                                            </span>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Full Name :</td>
                                    <td>{{ $studentDetails->s_fullName }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Phone Number :</td>
                                    <td>{{ $studentDetails->s_phoneNumber }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">E-Mail :</td>
                                    <td>{{ $studentDetails->s_email }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Gender :</td>
                                    <td>{{ $studentDetails->s_gender }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">School/College : </td>
                                    <td>{{ $studentDetails->s_college }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Class : </td>
                                    <td>{{ $studentDetails->s_class }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Subject : </td>
                                    <td>{{ $studentDetails->t_subject }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Medium : </td>
                                    <td>{{ $studentDetails->s_medium }}</td>
                                </tr>
                                <tr>
                                    <td>Student Address : </td>
                                    <td>{{ $studentDetails->districtName }} , {{ $studentDetails->s_area }} ,
                                        {{ $studentDetails->s_address }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Tutoring Type : </td>
                                    <td>{{ $studentDetails->tutoring_type }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase"><strong>Preferred Teacher :</strong> </td>
                                    <td>
                                        <h4>{{ $studentDetails->t_gender }}</h4>
                                    </td>
                                </tr>
                                @if (!empty($partner))
                                    <tr>
                                        <td class="text-uppercase">Lead Generator: </td>
                                        <td>
                                            <a href="{{ url('admin/uddokta_details/' . $partner->id) }}">
                                                <h6>{{ $partner->name }}</h6>
                                            </a>
                                        </td>
                                    </tr>
                                @endif


                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <h3>Tuition Info : </h3>
                        <hr>
                        <div class="my-2">
                            <div class="row py-1">
                                <div class="col-md-3">
                                    <strong>Current Status for Tuition : </strong>
                                </div>
                                <div class="col-md-7 text-left" id="value">
                                    <strong>Available</strong>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-3">
                                    <strong>Expected Minimum Salary:</strong>
                                </div>
                                <div class="col-md-7">
                                    <strong>{{ $studentDetails->t_salary }}</strong>
                                </div>
                            </div>

                            <div class="row py-1">
                                <div class="col-md-3">
                                    <strong>Days per week :</strong>
                                </div>
                                <div class="col-md-7">
                                    <strong>{{ $studentDetails->t_days }}</strong>
                                </div>
                            </div>

                            <div class="row py-1">
                                <div class="col-md-3">
                                    <strong>Preferred Subjects :</strong>
                                </div>
                                <div class="col-md-7">
                                    <strong>{{ $studentDetails->t_subject }}</strong>
                                </div>
                            </div>

                            <div class="row py-1">
                                <div class="col-3">
                                    <strong>Preferred Areas for tuition :</strong>
                                </div>
                                <div class="col-7">
                                    <strong class="text-success"> {{ $studentDetails->districtName }}</strong>
                                    <br>
                                    <h5>{{ $studentDetails->s_area }}</h5>
                                </div>
                            </div>

                            <div class="row py-1">
                                <div class="col-3">
                                    <strong>Extra Information :</strong>
                                </div>
                                <div class="col-7">

                                    <h5>{{ $studentDetails->ex_information }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 pb-3">
                            <div class="text-center">
                                <a href="{{ url('/admin/tuition/edit/') }}/{{ $studentDetails->id }}"
                                    class="btn btn-lg btn-info">Edit</a>
                                <a href="{{ url('admin/student_rejected') }}{{ $studentDetails->id }}"
                                    class="btn btn-lg btn-danger">Rejected</a>
                                @if ($studentDetails->approval == 1)
                                    <button class="btn btn-lg btn-success" disabled>Approved</button>
                                @else
                                    <a href="{{ url('admin/student_approval') }}{{ $studentDetails->id }}"
                                        class="btn btn-lg btn-success">Approved</a>
                                @endif

                                <a href="{{ url('admin/set_student_pending/' . $studentDetails->id) }}"
                                    class="btn btn-lg btn-warning">Set Pending</a>
                                <a href="{{ url('admin/set_student_cancel/' . $studentDetails->id) }}"
                                    class="btn btn-lg btn-dark">Set Cancel</a>
                            </div>
                        </div>
                    </div>



                    <div class="card-footer">

                        @if ($confirmed)
                            <h3>Cofirmed Teacher: </h3>
                            <hr>
                            <div class="card mb-3">
                                <div class="row">
                                    <div class="col-md-2 col-sm-5 col-xs-12 text-center">
                                        <a href="{{ url('/admin/teacher_details') }}{{ $confirmed->teacher->id }}">

                                            <img class="styleBorderImg"
                                                src="{{ asset($confirmed->teacher->teacher->teacher_profile_picture) }}"
                                                alt="{{ $confirmed->teacher->teacher->teacher_profile_picture }}"
                                                onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/teacher/icons/instagram-ui-twotone/48/Paul-18-512.png';" /></a>
                                        <br>
                                        <strong>ID # {{ $confirmed->teacher->teacher->teacher_id }} </strong>
                                    </div>
                                    <div class="col-md-4 col-sm-7 col-xs-12"> <strong><span class="text-info">
                                                {{ $confirmed->teacher ? $confirmed->teacher->name : '' }} </span></strong>
                                        <br>
                                        <span style="color: green;"> Member Since:
                                            {{ $confirmed->teacher->teacher->created_at->format('d-M-Y') }} </span>
                                        <br>
                                        <span>{{ $confirmed->teacher->teacher->tuition_salary }}</span> <br>
                                        <strong>Qualification:</strong> {{ $confirmed->teacher->teacher->teacher_degree }}
                                        <br>
                                        <strong>Honours Ins:</strong> {{ $confirmed->teacher->teacher->honours_institute }}
                                        <br>
                                        <strong>Tuition Me:</strong> {{ $confirmed->teacher->teacher->tuition_medium }}
                                        <br>
                                        <strong>Teaching:</strong> {{ $confirmed->teacher->teacher->tuition_subject }}
                                        <br><br>


                                    </div>
                                    <div class="col-md-4 space-htop">
                                        <span class="badge badge-pill badge-success badge-sm my-2 w-100">Confirmed</span>
                                        <strong>Assigned at:</strong>{{ $confirmed->created_at->format('h:i A | d-M-Y') }}
                                        <br>
                                        <strong>Assigned by:</strong>{{ $confirmed->confirmed_by }}<br>
                                        <strong>Remark:</strong>{{ $confirmed->remark }} <br>
                                        <hr>
                                        <strong>Fee:</strong>{{ $confirmed->fee }} <br>
                                        <strong>Advance:</strong>{{ $confirmed->advance }} <br>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-sm-12 ml-2 mb-1">
                                        <strong>Experience:</strong> {{ $confirmed->teacher->teacher->tuition_experience }}
                                    </div>
                                </div>
                            </div>
                        @elseif($assigned_list->count() > 0)
                            <h3>Assigned Teacher: </h3>
                            <hr>
                            @foreach ($assigned_list as $assigned)
                                <div class="card mb-3">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-5 col-xs-12 text-center">
                                            <a href="{{ url('/admin/teacher_details') }}{{ $assigned->teacher->id }}">

                                                <img class="styleBorderImg"
                                                    src="{{ asset($assigned->teacher->teacher->teacher_profile_picture) }}"
                                                    alt="{{ $assigned->teacher->teacher->teacher_profile_picture }}"
                                                    onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/teacher/icons/instagram-ui-twotone/48/Paul-18-512.png';" /></a>
                                            <br>
                                            <strong>ID # {{ $assigned->teacher->teacher->teacher_id }} </strong>
                                        </div>
                                        <div class="col-md-4 col-sm-7 col-xs-12"> <strong><span class="text-info">
                                                    {{ $assigned->teacher ? $assigned->teacher->name : '' }}
                                                </span></strong> <br>
                                            <span style="color: green;"> Member Since:
                                                {{ $assigned->teacher->teacher->created_at->format('d-M-Y') }} </span>
                                            <br>
                                            <span>{{ $assigned->teacher->teacher->tuition_salary }}</span> <br>
                                            <strong>Qualification:</strong>
                                            {{ $assigned->teacher->teacher->teacher_degree }} <br>
                                            <strong>Honours Ins:</strong>
                                            {{ $assigned->teacher->teacher->honours_institute }} <br>
                                            <strong>Tuition Me:</strong> {{ $assigned->teacher->teacher->tuition_medium }}
                                            <br>
                                            <strong>Teaching:</strong> {{ $assigned->teacher->teacher->tuition_subject }}
                                            <br><br>


                                        </div>
                                        <div class="col-md-4 space-htop">
                                            <span
                                                class="badge badge-pill badge-warning badge-sm my-2 w-100">Assigned</span>
                                            <strong>Assigned
                                                at:</strong>{{ $assigned->created_at->format('h:i A | d-M-Y') }} <br>
                                            <strong>Assigned by:</strong>{{ $assigned->assigned_by }}<br>
                                            <strong>Remark:</strong>{{ $assigned->remark }} <br>

                                            <br>

                                            <a data-toggle="modal" data-target="#editModalAssign{{ $assigned->id }}"
                                                class="btn btn-outline-danger btn-sm">Edit</a>

                                            <div class="modal fade" id="editModalAssign{{ $assigned->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ url('admin/assigned_teacher/edit/' . $assigned->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="teacher_id"
                                                                    value="{{ $assigned->teacher->id }}" />
                                                                <input type="hidden" name="student_id"
                                                                    value="{{ $studentDetails->id }}" />
                                                                <div class="form-group">
                                                                    <h5 for="text-danger">Update Info:</h5>
                                                                    <hr>
                                                                    <input name="assigned_by"
                                                                        value="{{ $assigned->assigned_by }}"
                                                                        class="form-control my-2"
                                                                        placeholder="Rejected By" required="required">
                                                                    <textarea placeholder="Enter reason..." class="form-control" name="remark" rows="5" required>{{ $assigned->remark }}</textarea>
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-lg btn-outline-primary px-4">Submit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-md-2">

                                            <button type="button" class="btn btn-sm btn-outline-danger px-4 mt-2 w-100"
                                                data-toggle="modal" data-target="#rejectModal{{ $assigned->id }}">
                                                <i class="fa fa-close" style="color:red"></i>
                                                Reject
                                            </button>

                                            <button type="button" class="btn btn-lg btn-outline-success px-3 mt-2 w-100"
                                                data-toggle="modal" data-target="#confirmedModal{{ $assigned->id }}">
                                                <i class="fa fa-check" style="color:green"></i>
                                                Confirm
                                            </button>



                                            <!-- Modal -->
                                            <div class="modal fade" id="rejectModal{{ $assigned->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <form action="{{ url('admin/reject_teacher') }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="teacher_id"
                                                                    value="{{ $assigned->teacher->id }}" />
                                                                <input type="hidden" name="student_id"
                                                                    value="{{ $studentDetails->id }}" />
                                                                <div class="form-group">
                                                                    <h5 for="text-danger">Are you sure to Reject him/her?
                                                                    </h5>
                                                                    <hr>
                                                                    <input name="rejected_by" class="form-control my-2"
                                                                        placeholder="Rejected By" required="required">
                                                                    <textarea placeholder="Enter reason..." class="form-control" name="reason" rows="5" required></textarea>
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-lg btn-outline-primary px-4">Submit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="confirmedModal{{ $assigned->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <form action="{{ url('admin/confirm_teacher') }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="teacher_id"
                                                                    value="{{ $assigned->teacher->id }}" />
                                                                <input type="hidden" name="student_id"
                                                                    value="{{ $studentDetails->id }}" />
                                                                <div class="form-group">
                                                                    <h5 for="text-danger">Are you sure to Confirm him/her?
                                                                    </h5>
                                                                    <hr>
                                                                    <input name="confirmed_by" class="form-control my-2"
                                                                        placeholder="Confirmed By" required="required">
                                                                    <textarea placeholder="Enter remark..." class="form-control" name="remark" rows="5"></textarea>
                                                                    @if ($studentDetails->lead_generator)
                                                                        <hr>
                                                                        <label>Set Salary (Fixed Salary is required for Lead
                                                                            Job):</label>
                                                                        <input name="salary" id="t_salary"
                                                                            class="form-control my-2"
                                                                            value="{{ $studentDetails->t_salary }}"
                                                                            required="required">
                                                                        <label>Set Lead Comission (Default: 10%):</label>
                                                                        <input name="lead_percentage" id="lead_percentage"
                                                                            class="form-control my-2" value="10"
                                                                            required="required">
                                                                    @endif
                                                                </div>
                                                                <hr>

                                                                <h5 class="text-center">Tuition Fee: <span
                                                                        id="tuitionFee">{{ (int) $studentDetails->t_salary }}</span>
                                                                    Tk</h5>

                                                                <div class="form-group">
                                                                    <span for="text-danger">Comission Fee (Default 60% ):
                                                                        <sup style="color: red">*</sup></span>
                                                                    <input type="number" min="0" name="fee"
                                                                        id="fee" class="form-control my-2"
                                                                        required="required">
                                                                    <span for="text-danger">Advance:</span>
                                                                    <input type="number" min="0" name="advance"
                                                                        class="form-control my-2">
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-lg btn-outline-primary px-4">Submit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 ml-2 mb-1">
                                            <strong>Experience:</strong>
                                            {{ $assigned->teacher->teacher->tuition_experience }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-warning show" role="alert">
                                <strong>No One is Assigned Yet! </strong>
                            </div>
                        @endif

                        @if ($rejected_list->count() > 0)
                            <h4 class="text-danger">Rejected Teacher: </h4>
                            <hr>
                            @foreach ($rejected_list as $assigned2)
                                @if ($assigned2->teacher)
                                    <div class="card mb-3">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-5 col-xs-12 text-center">
                                                <a
                                                    href="{{ url('/admin/teacher_details') }}{{ $assigned2->teacher->id }}">

                                                    <img class="styleBorderImg"
                                                        src="{{ asset($assigned2->teacher->teacher->teacher_profile_picture) }}"
                                                        alt="{{ $assigned2->teacher->teacher->teacher_profile_picture }}"
                                                        onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/teacher/icons/instagram-ui-twotone/48/Paul-18-512.png';" /></a>
                                                <br>
                                                <strong>ID # {{ $assigned2->teacher->teacher->teacher_id }} </strong>
                                            </div>
                                            <div class="col-md-4 col-sm-7 col-xs-12"> <strong><span class="text-info">
                                                        {{ $assigned2->teacher ? $assigned2->teacher->name : '' }}
                                                    </span></strong> <br>
                                                <span style="color: green;"> Member Since:
                                                    {{ $assigned2->teacher->teacher->created_at->format('d-M-Y') }}
                                                </span>a
                                                <br>
                                                <span>{{ $assigned2->teacher->teacher->tuition_salary }}</span> <br>
                                                <strong>Qualification:</strong>
                                                {{ $assigned2->teacher->teacher->teacher_degree }} <br>
                                                <strong>Honours Ins:</strong>
                                                {{ $assigned2->teacher->teacher->honours_institute }} <br>
                                                <strong>Tuition Me:</strong>
                                                {{ $assigned2->teacher->teacher->tuition_medium }}
                                                <br>
                                                <strong>Teaching:</strong>
                                                {{ $assigned2->teacher->teacher->tuition_subject }}
                                                <br><br>


                                            </div>
                                            <div class="col-md-4 space-htop">
                                                <span
                                                    class="badge badge-pill badge-danger badge-sm my-2 w-100">Rejected</span>
                                                <strong>Rejected
                                                    at:</strong>{{ $assigned2->created_at->format('h:i A | d-M-Y') }} <br>
                                                <strong>Rejected by:</strong>{{ $assigned2->rejected_by }}<br>
                                                <strong>Reason:</strong>{{ $assigned2->reason }} <br>
                                            </div>

                                            <div class="col-sm-12 ml-2 mb-1">
                                                <strong>Experience:</strong>
                                                {{ $assigned2->teacher->teacher->tuition_experience }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Matched Teacher by Requirements</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Applied Teacher</button>
        </li>
        <li class="nav-item" role="presentation" class="float-right">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                role="tab" aria-controls="contact" aria-selected="false">Find Teacher</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-3 mb-2 text-center row">
                        <h5>Tuition match teacher profile: {{ isset($teacher) ? $teacher->count() : 0 }} <a
                                href="{{ url('/admin/receiver_list/' . $studentDetails->id) }}" type="button"
                                class="btn btn-success mx-5">Generate Multiple Message</a> </h5>
                    </div>
                    @forelse($teacher as $profile)
                        <div class="card mb-3">
                            <div class="row">
                                <div class="col-md-2 col-sm-5 col-xs-12 text-center">
                                    <a href="{{ url('/tutor_details') }}/{{ $profile->teacher_id }}">
                                        <img class="styleBorderImg" src="{{ asset($profile->teacher_profile_picture) }}"
                                            alt=""
                                            onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/data/icons/instagram-ui-twotone/48/Paul-18-512.png';" /></a>
                                    <br>
                                    <strong>ID # {{ $profile->teacher_id }} </strong>
                                </div>
                                <div class="col-md-4 col-sm-7 col-xs-12"> <strong><span class="text-info">
                                            {{ $profile->user ? $profile->user->name : '' }} </span></strong> <br>
                                    <span style="color: green;"> Member Since: {{ substr($profile->created_at, 0, 10) }}
                                    </span> <br>
                                    <span>{{ $profile->tuition_salary }}</span> <br>
                                    <strong>Qualification:</strong> {{ $profile->teacher_degree }} <br>
                                    <strong>Honours Ins:</strong> {{ $profile->honours_institute }} <br>
                                    <strong>Tuition Me:</strong> {{ $profile->tuition_medium }} <br>
                                    <strong>Teaching:</strong> {{ $profile->tuition_subject }}
                                </div>
                                <div class="col-sm-3 space-htop">
                                    <strong>{{ $profile->districts ? $profile->districts->districtName : '' }}
                                        <br></strong> <span class="text-lowercase">{{ $profile->tuition_area }}</span>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ url('/admin/teacher_details') }}{{ $profile->user_id }}"
                                        class="btn btn-lg btn-info mt-2">View Details</a>
                                    <button type="button" class="btn btn-lg btn-primary mt-2" data-toggle="modal"
                                        data-target="#exampleModal{{ $profile->user_id }}"
                                        {{ $confirmed ? 'disabled' : '' }}>
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        Assign Teacher
                                    </button>
                                </div>
                                <div class="col-sm-12 ml-2 mb-1">
                                    <strong>Experience:</strong> {{ $profile->tuition_experience }}
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $profile->user_id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="{{ url('admin/assign_teacher') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="teacher_id" value="{{ $profile->user_id }}" />
                                            <input type="hidden" name="student_id"
                                                value="{{ $studentDetails->id }}" />
                                            <div class="form-group">
                                                <h5 for="exampleInputEmail1">Are you sure to assign him/her?</h5>
                                                <hr>
                                                <input name="assigned_by" class="form-control my-2"
                                                    placeholder="Assigned By" required="required">
                                                <textarea placeholder="Enter remark..." class="form-control" name="remark" rows="5"></textarea>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-lg btn-outline-primary px-4">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>This tuition not any teacher profile match</p>
                    @endforelse
                    <div class="pull-right mt-3 mr-5">
                        {{ $teacher->appends(Request::except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-3 mb-2 text-center">
                        <h5>Applied teacher profile: {{ isset($applied_teacher) ? $applied_teacher->count() : 0 }} <a
                                href="{{ url('/admin/applied_receiver_list/' . $studentDetails->id) }}" type="button"
                                class="btn btn-success mx-5">Generate Message</a></h5>
                    </div>


                    @foreach ($applied_teacher as $data)
                        @if ($data->profile)
                            <div class="card mb-3">
                                <div class="row">
                                    <div class="col-md-2 col-sm-5 col-xs-12 text-center">
                                        <a href="{{ url('/tutor_details') }}/{{ $data->profile->teacher_id ?? '' }}">

                                            <img class="styleBorderImg"
                                                src="{{ asset($data->profile->teacher_profile_picture ?? '') }}"
                                                alt="{{ $data->teacher ? $data->teacher->name : '' }}"
                                                onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/data/icons/instagram-ui-twotone/48/Paul-18-512.png';" /></a>
                                        <br>
                                        <strong>ID # {{ $data->profile->teacher_id }} </strong>
                                    </div>
                                    <div class="col-md-4 col-sm-7 col-xs-12"> <strong><span class="text-info">
                                                {{ $data->teacher ? $data->teacher->name : '' }} </span></strong><br>
                                        <div>
                                            @if ($data->teacher && $data->teacher->approval == 1)
                                                <span class="badge badge-pill badge-success px-4">Approved</span>
                                            @elseif($data->teacher && $data->teacher->approval == 3)
                                                <span class="badge badge-pill badge-danger px-4">Rejected</span>
                                            @else
                                                <span class="badge badge-pill badge-warning px-4">Pending</span>
                                            @endif

                                            @if ($data->teacher && $data->teacher->verified == 1)
                                                <span class="badge badge-pill badge-primary px-4"><i
                                                        class="fa fa-star font-14"></i> Verified</span>
                                            @endif


                                            @if ($data->profile->home_approval == 1)
                                                <span class="badge badge-pill badge-danger px-4"><i
                                                        class="fa fa-heart font-14"></i> Premium</span>
                                            @endif
                                        </div>
                                        <span style="color: green;"> Member Since:
                                            {{ $data->profile->created_at->format('d-M-Y') ?? '' }} </span> <br>
                                        <span>{{ $data->profile->tuition_salary ?? '' }}</span> <br>
                                        <strong>Qualification:</strong> {{ $data->profile->teacher_degree ?? '' }} <br>
                                        <strong>Honours Ins:</strong> {{ $data->profile->honours_institute ?? '' }} <br>
                                        <strong>Tuition Me:</strong> {{ $data->profile->tuition_medium ?? '' }} <br>
                                        <strong>Teaching:</strong> {{ $data->profile->tuition_subject ?? '' }}
                                        <br><br>

                                        <strong>Applied:</strong> {{ $data->created_at->format('h:i A | d-M-Y') }}
                                    </div>
                                    <div class="col-md-3 space-htop">
                                        <strong>{{ $data->profile->districts ? $data->profile->districts->districtName : '' }}
                                            <br></strong> <span
                                            class="text-lowercase">{{ $data->profile->tuition_area ?? '' }}</span>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ url('/admin/teacher_details') }}{{ $data->profile->user_id }}"
                                            class="btn btn-lg btn-info mt-2">View Details</a>


                                        <button type="button" class="btn btn-lg btn-primary mt-2" data-toggle="modal"
                                            data-target="#exampleModal{{ $data->profile->user_id }}"
                                            {{ $confirmed ? 'disabled' : '' }}>
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            Assign Teacher
                                        </button>



                                    </div>
                                    <div class="col-sm-12 ml-2 mb-1">
                                        <strong>Experience:</strong> {{ $data->profile->tuition_experience }}
                                    </div>
                                </div>
                            </div>




                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $data->profile->user_id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="{{ url('admin/assign_teacher') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="teacher_id"
                                                    value="{{ $data->profile->user_id }}" />
                                                <input type="hidden" name="student_id"
                                                    value="{{ $studentDetails->id }}" />
                                                <div class="form-group">
                                                    <h5 for="exampleInputEmail1">Are you sure to assign him/her?</h5>
                                                    <hr>
                                                    <input name="assigned_by" class="form-control my-2"
                                                        placeholder="Assigned By" required="required">
                                                    <textarea placeholder="Enter remark..." class="form-control" name="remark" rows="5"></textarea>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-lg btn-outline-primary px-4">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach


                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="page-content my-5">
                <div class="row justify-content-md-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center"><strong>Select Teacher</strong></h3>
                            </div>
                            <div class="card-body">
                                <form id="create-form">


                                    <input type="hidden" name="student_id" value="{{ $studentDetails->id }}" />
                                    <input type="hidden" name="confirmed" value="{{ $confirmed ? '1' : '0' }}" />

                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="exampleInputPassword1">Teacher Id:</label>
                                            <input type="text" class="form-control" id="teacher_id" name="teacher_id"
                                                placeholder="Teacher Id">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="exampleInputPassword1">Teacher Phone:</label>
                                            <input type="text" class="form-control" id="teacher_phone"
                                                name="teacher_phone" placeholder="Teacher Phone Number">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="text-center">

                                        <button type="submit" id="btnSendData"
                                            class="btn btn-primary px-5">Submit</button>

                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class=" mt-3">
                            <div id="teacher_box"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

@endsection



@section('script')

    <script>
        $(document).on('click', '#btnSendData', function(event) {

            event.preventDefault();

            let text = "";

            var form = $('#create-form')[0];
            var formData = new FormData(form);
            // Set header if need any otherwise remove setup part
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
                }
            });
            $.ajax({
                url: "{{ route('admin.find_teacher') }}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(res) {
                    $("#teacher_box").empty();
                    $("#teacher_box").append(res);
                },
                error: function(data) {
                    $.each(data.responseJSON.errors, function(key, value) {
                        ErrorMessage(key, value); // validation message show
                    });
                }
            });
        });
    </script>

    <script>
        const tSalaryInput = document.getElementById('t_salary');
        const feeInput = document.getElementById('fee');
        const tuitionFee = document.getElementById('tuitionFee');
        const leadPercentageInput = document.getElementById(
        'lead_percentage'); // Assuming there is only one element with this name

        tSalaryInput.addEventListener('input', function() {
            const tSalary = parseFloat(tSalaryInput.value);
            const fee = Math.round(tSalary * 0.6); // Round to the nearest integer
            feeInput.value = fee;
            tuitionFee.textContent = tSalary;

            leadbonus = Math.round(fee * 0.1);
            leadPercentageInput.value = leadbonus;
        });
    </script>




@endsection
