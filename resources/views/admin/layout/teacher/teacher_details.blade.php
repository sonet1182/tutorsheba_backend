@extends('admin.master')

@section('title', 'Teacher Details | Admin')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Tutor ID# {{ $teacherDetails->teacher_id }}</h1>
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
                        <h3 class="text-center">Tutor ID# {{ $teacherDetails->teacher_id }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 " align="center"> <img alt="User Pic"
                                    src="{{ empty($teacherDetails->teacher_profile_picture) ? asset('images/allUsers.jpg') : asset($teacherDetails->teacher_profile_picture) }}"
                                    class="img-thumbnail img-responsive" style="width: 240px;height: 280px"
                                    onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/data/icons/instagram-ui-twotone/48/Paul-18-512.png';">
                            </div>
                            <div class="col-xs-12 col-md-8 col-lg-8 ">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td>Created Time :</td>
                                            <td><b>{{ date('d M, Y', strtotime($teacherDetails->created_at)) }} At
                                                    {{ date('g:ia', strtotime($teacherDetails->created_at)) }}</b></td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase">Status :</td>
                                            <td>
                                                @if ($teacherDetails->user)
                                                    @if ($teacherDetails->user->approval == 1)
                                                        <span class="badge badge-pill badge-success px-4">Approved</span>
                                                    @elseif($teacherDetails->user->approval == 3)
                                                        <span class="badge badge-pill badge-danger px-4">Rejected</span>
                                                    @else
                                                        <span class="badge badge-pill badge-warning px-4">Pending</span>
                                                    @endif
                                                @endif

                                                @if ($teacherDetails->user)
                                                    @if ($teacherDetails->user->verified == 1)
                                                        <span class="badge badge-pill badge-primary px-4"><i
                                                                class="fa fa-star font-14"></i> Verified</span>
                                                    @endif
                                                @endif

                                                @if ($teacherDetails->home_approval == 1)
                                                    <span class="badge badge-pill badge-danger px-4"><i
                                                            class="fa fa-heart font-14"></i> Premium</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase">Full Name :</td>
                                            <td>{{ $teacherDetails->user ? $teacherDetails->user->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase">Phone Number :</td>
                                            <td><b>{{ $teacherDetails->user ? $teacherDetails->user->phoneNumber : '' }}</b></td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase">Alt Number :</td>
                                            <td>{{ $teacherDetails->a_phone_number }} , {{ $teacherDetails->ex_phone_one ?? '' }} , {{ $teacherDetails->ex_phone_two ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase">E-Mail :</td>
                                            <td>{{ $teacherDetails->user ? $teacherDetails->user->email : $teacherDetails->user_id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase">Gender :</td>
                                            <td>{{ $teacherDetails->teacher_gender }}</td>
                                        </tr>

                                        <tr>
                                            <td>Present Address : </td>
                                            <td>City: <strong>{{ $teacherDetails->owndistricts ? $teacherDetails->owndistricts->districtName : '' }}</strong> </br> Area: <strong>{{ $teacherDetails->teacher_present_address }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Parmanent Address : </td>
                                            <td>{{ $teacherDetails->teacher_permanent_address }}</td>
                                        </tr>


                                    </tbody>
                                </table>

                                <table>
                                    <h5 class="py-2"><u>Honours Education Info:</u></h5>

                                    <tbody>
                                        <tr>
                                            <td class="text-uppercase">Institution Type : </td>
                                            <th>{{ $teacherDetails->institype ? $teacherDetails->institype->name : '' }}</th>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase">Institution : </td>
                                            <th>{{ $teacherDetails->honours_institute ? $teacherDetails->honours_institute : $teacherDetails->teacher_university }}</th>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase">Background Medium : </td>
                                            <th>{{ $teacherDetails->honours_curriculam ? $teacherDetails->honours_curriculam : $teacherDetails->teacher_bk_medium }}</th>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase">Subject : </td>
                                            <th>{{ $teacherDetails->honours_subject ? $teacherDetails->honours_subject : $teacherDetails->teacher_subject }}</th>
                                        </tr>
                                        <tr>
                                            <td>Qualification/Degree : </td>
                                            <th>{{ $teacherDetails->studytype ? $teacherDetails->studytype->name : $teacherDetails->teacher_degree }}</th>
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
                                        <th>Curriculum</th>
                                        <th>GPA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">SSC</th>
                                        <td>{{ $teacherDetails->ssc_institute }}</td>
                                        <td>{{ $teacherDetails->ssc_year }}</td>
                                        <td>{{ $teacherDetails->ssc_group }}</td>
                                        <td>{{ $teacherDetails->ssc_curriculam }}</td>
                                        <td>{{ $teacherDetails->ssc_gpa }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">HSC</th>
                                        <td>{{ $teacherDetails->hsc_institute }}</td>
                                        <td>{{ $teacherDetails->hsc_year }}</td>
                                        <td>{{ $teacherDetails->hsc_group }}</td>
                                        <td>{{ $teacherDetails->hsc_curriculam }}</td>
                                        <td>{{ $teacherDetails->hsc_gpa }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Honours</th>
                                        <td><strong>Study Type:</strong> {{$teacherDetails->studytype ? $teacherDetails->studytype->name : "" }} <br>
                                            <strong>Institute Type:</strong> {{$teacherDetails->institype ? $teacherDetails->institype->name : "" }} <br>
                                            <strong>Institute:</strong> <b>{{ $teacherDetails->honours_institute }}</b>
                                        </td>
                                        <td>{{ $teacherDetails->honours_year }}</td>
                                        <td>{{ $teacherDetails->honours_subject }}</td>
                                        <td>{{ $teacherDetails->honours_curriculam }}</td>
                                        <td>{{ $teacherDetails->honours_gpa }}</td>
                                    </tr>
                                </tbody>
                            </table>



                            <div class="row">
                                <div class="col-md-6">
                                    <img style="width: 100%; height: 250px" class="img-responsive img-thumbnail"
                                        src="{{ isset($teacherDetails->user->verify) ? asset('nid_card/' . $teacherDetails->user->verify->nid_card) : asset('admins/img/nid.jpg') }}"
                                        title="" />
                                </div>
                                <div class="col-md-6">
                                    <img style="width: 100%; height: 250px" class="img-responsive img-thumbnail"
                                        src="{{ isset($teacherDetails->user->verify) ? asset('student_card/' . $teacherDetails->user->verify->student_card) : asset('admins/img/student.jpg') }}"
                                        title="" />
                                </div>
                            </div>




                            <div class="text-center my-5">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-lg btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    Send Message
                                </button>


                                <a href="{{ url('admin/teacher_rejected') }}{{ $teacherDetails->id }}"
                                    class="btn btn-lg btn-warning">Rejected</a>
                                <a href="{{ url('admin/teacher_approval') }}{{ $teacherDetails->user_id }}"
                                    class="btn btn-lg btn-primary">Approve</a>
                                <a href="{{ url('admin/teacher_verify') }}{{ $teacherDetails->user_id }}"
                                    class="btn btn-lg btn-info"><i class="fa fa-star font-14"></i> Verify</a>
                                <a href="{{ url('admin/teacher_premium') }}{{ $teacherDetails->user_id }}"
                                    class="btn btn-lg btn-danger">Premium Membership</a>
                                <a href="{{ url('admin/balance/create') }}/{{ $teacherDetails->id }}"
                                    class="btn btn-lg btn-success">Add Balance</a>
                                <button type="button"
                                    data-href="{{ url('/admin/tutor-list/delete/'.$teacherDetails->user_id) }}"
                                    class="btn btn-lg btn-danger delete_barcode_button"><i class="fa fa-trash font-14">
                                        Delete</i></button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="alert alert-info fade show mt-3" role="alert">
            <b class="text-center">
                Job History
            </b>
        </div>

        <div class="row mt-3">

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/admin/apply_tuition_list/' . $teacherDetails->user_id) }}"
                    class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Applied Jobs</div>
                                <div class="h5 mb-0 font-weight-bold text-info">{{ $applied }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-dashboard fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/admin/assigned_tuition_list/' . $teacherDetails->user_id) }}"
                    class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assigned Jobs</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $assigned }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-refresh fa-spin fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/admin/confirmed_tuition_list/' . $teacherDetails->user_id) }}"
                    class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Confirmed Jobs</div>
                                <div class="h5 mb-0 font-weight-bold text-success">{{ $confirmed }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-solid fa-heart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/admin/cancelled_tuition_list/' . $teacherDetails->user_id) }}"
                    class="card shadow h-100 py-2" style="border-left: 4px solid #eb3933;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cancelled Jobs</div>
                                <div class="h5 mb-0 font-weight-bold text-danger">{{ $cancelled }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-exclamation-triangle fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>




        </div>

















        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ url('admin/send_text') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $teacherDetails->user_id }}" />
                            <div class="form-group">
                                <h5 for="exampleInputEmail1">Enter Message Here...</h5>
                                <hr>
                                <textarea placeholder="" class="form-control" name="message" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-lg btn-outline-primary px-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('click', 'button.delete_barcode_button', function() {
            if (confirm("Are you sure you want to delete this?")) {
                var href = $(this).data('href');
                $.ajax({
                    method: "GET",
                    url: href,
                    success: function(result) {
                        alert(result.msg);
                    }
                });
            } else {
                return false;
            }
        });
    </script>
@endsection
