@extends('admin.master')


@section('content')

    <div class="page-heading">
        <h1 class="page-title">Details for Request</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/teacher_tuition_request') }}">Teacher Tuition Request</a></li>
                <li class="breadcrumb-item active" aria-current="page">Student Tutor Request</li>
            </ol>
        </nav>
    </div>

    @if (session('teacherRequest'))
        <div class="alert alert-danger text-center">
            <h3 class="text-success">{{ session('teacherRequest') }}</h3>
        </div>
    @endif

    <div class="page-content">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Request ID#{{ $tuitionRequest->id }}</h3>
                        <h6 class="text-center">Request Time# {{ $tuitionRequest->created_at }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 " align="center"> <img alt="User Pic" src="{{ empty($teacherDetails->teacher_profile_picture) ? asset('images/allUsers.jpg') : asset($teacherDetails->teacher_profile_picture) }}" class="img-thumbnail img-responsive" style="width: 240px;height: 280px"> </div>
                            <div class="col-xs-12 col-md-8 col-lg-8 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Created Time :</td>
                                        <td><b>{{ date('d M, Y',strtotime($teacherDetails->created_at)) }} At {{ date('g:ia',strtotime($teacherDetails->created_at)) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">Approval :</td>
                                        <td>{{ $teacherDetails->approval }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">Home Approval :</td>
                                        <td>{{ $teacherDetails->home_approval }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">Full Name :</td>
                                        <td>{{ $teacherDetails->user ? $teacherDetails->user->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">Phone Number :</td>
                                        <td>{{ $teacherDetails->user ? $teacherDetails->user->phoneNumber : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">Alt Number :</td>
                                        <td>{{ $teacherDetails->a_phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">E-Mail :</td>
                                        <td>{{ $teacherDetails->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">Gender :</td>
                                        <td>{{ $teacherDetails->teacher_gender }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">Institution : </td>
                                        <td>{{ $teacherDetails->teacher_university }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">Background Medium : </td>
                                        <td>{{ $teacherDetails->teacher_bk_medium }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">Subject : </td>
                                        <td>{{ $teacherDetails->teacher_subject }}</td>
                                    </tr>
                                    <tr>
                                        <td>Qualification/Degree : </td>
                                        <td>{{ $teacherDetails->teacher_degree }}</td>
                                    </tr>
                                    <tr>
                                        <td>Present Address : </td>
                                        <td>{{ $teacherDetails->teacher_present_address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Parmanent Address : </td>
                                        <td>{{ $teacherDetails->teacher_permanent_address }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h3>Tuition Info : </h3>
                        <hr>
                        <div class="col-md-12">
                            <div class="row py-1">
                                <div class="col-4">
                                    <strong>Current Status for Tuition : </strong>
                                </div>
                                <div class="col-7">
                                    <strong>Available</strong>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-4">
                                    <strong>Expected Minimum Salary:</strong>
                                </div>
                                <div class="col-7">
                                    <strong>{{ $teacherDetails->tuition_salary }}</strong>
                                </div>
                            </div>

                            <div class="row py-1">
                                <div class="col-4">
                                    <strong>Days per week :</strong>
                                </div>
                                <div class="col-7">
                                    <strong>{{ $teacherDetails->tuition_days }}</strong>
                                </div>
                            </div>


                            <div class="row py-1">
                                <div class="col-4">
                                    <strong>Preferred Medium Of Education :</strong>
                                </div>
                                <div class="col-7">
                                    <strong>{{ $teacherDetails->tuition_medium }}</strong>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-4">
                                    <strong>Preffered Tutoring Style :</strong>
                                </div>
                                <div class="col-7">
                                    <strong>{{ $teacherDetails->tuition_style }} </strong>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-4">
                                    <strong>Preferred Classes :</strong>
                                </div>
                                <div class="col-7">
                                    <strong>{{ $teacherDetails->tuition_class }} </strong>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-4">
                                    <strong>Preferred Subjects :</strong>
                                </div>
                                <div class="col-7">
                                    <strong>{{ $teacherDetails->tuition_subject }}</strong>
                                </div>
                            </div>

                            <div class="row py-1">
                                <div class="col-4">
                                    Preferred Areas for tuition :
                                </div>
                                <div class="col-7">
                                    <strong>{{ $teacherDetails->districts ? $teacherDetails->districts->districtName : '' }}</strong>
                                    <br>
                                    {{ $teacherDetails->tuition_area }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h3>Educational Qualification : </h3>
                            <div class="c9" style="background:#848484; height:1px;"></div>
                            <table class="table mt-2">
                                <thead>
                                <tr class="bg-secondary text-light">
                                    <th>Public Exam</th>
                                    <th>institute</th>
                                    <th>Year</th>
                                    <th>Group</th>
                                    <th>GPA</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">SSC</th>
                                    <td>{{ $teacherDetails->ssc_institute }}</td>
                                    <td>{{ $teacherDetails->ssc_year }}</td>
                                    <td>{{ $teacherDetails->ssc_group }}</td>
                                    <td>{{ $teacherDetails->ssc_gpa }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">HSC</th>
                                    <td>{{ $teacherDetails->hsc_institute }}</td>
                                    <td>{{ $teacherDetails->hsc_year }}</td>
                                    <td>{{ $teacherDetails->hsc_group }}</td>
                                    <td>{{ $teacherDetails->hsc_gpa }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Honours</th>
                                    <th>{{ $teacherDetails->honours_institute }}</th>
                                    <td>{{ $teacherDetails->honours_year }}</td>
                                    <td>{{ $teacherDetails->honours_subject }}</td>
                                    <td>{{ $teacherDetails->honours_gpa }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-center my-5">
                                <a href="{{ url('admin/teacher_rejected') }}{{ $teacherDetails->id }}" class="btn btn-lg btn-danger">Rejected</a>
                                <a href="{{ url('admin/teacher_approval') }}{{ $teacherDetails->id }}" class="btn btn-lg btn-primary">Approved</a>
                                <a href="{{ url('admin/membership/create') }}/{{ $teacherDetails->id }}" class="btn btn-lg btn-info">Premium Membership Approved</a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="text-center">ID# 01000{{ $studentDetails->id }} <strong>Student Information</strong></h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td class="text-uppercase">request time :</td>
                                <td><b>{{ date('d M, Y',strtotime($studentDetails->created_at)) }} At {{ date('g:ia',strtotime($studentDetails->created_at)) }}</b></td>
                            </tr>
                            <tr>
                                <td class="text-uppercase">Approval :</td>
                                <td>{{ $studentDetails->approval }}</td>
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
                                <td class="text-uppercase">Medium : </td>
                                <td>{{ $studentDetails->s_medium }}</td>
                            </tr>
                            <tr>
                                <td>Student Address : </td>
                                <td>{{ $studentDetails->districtName }} , {{ $studentDetails->s_area }} , {{ $studentDetails->s_address }}</td>
                            </tr>
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
                        </div>
                        <div class="mt-5 pb-3">
                            <div class="text-center">
                                <a href="{{ url('admin/student_rejected') }}{{ $studentDetails->id }}" class="btn btn-lg btn-danger">Rejected</a>
                                <a href="{{ url('admin/student_approval') }}{{ $studentDetails->id }}" class="btn btn-lg btn-success">Approved</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
