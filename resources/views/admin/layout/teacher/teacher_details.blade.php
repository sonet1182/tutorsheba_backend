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
                                    class="img-thumbnail img-responsive" style="width: 220px;height: 220px"
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
                                            <td><b>{{ $teacherDetails->user ? $teacherDetails->user->phoneNumber : '' }}</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase">Alternative Number :</td>
                                            <td>{{ $teacherDetails->a_phone_number }}</td>
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
                                            <td>City:
                                                <strong>{{ $teacherDetails->owndistricts ? $teacherDetails->owndistricts->districtName : '' }}</strong>
                                                </br> Area: <strong>{{ $teacherDetails->teacher_present_address }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Parmanent Address : </td>
                                            <td>{{ $teacherDetails->teacher_permanent_address }}</td>
                                        </tr>


                                    </tbody>
                                </table>


                                <div class="row">
                                    <div class="col-md-6">

                                        <table>
                                            <h5 class="py-2"><u>Honours Education Info:</u></h5>

                                            <tbody>
                                                <tr>
                                                    <td class="text-uppercase">Institution Type : </td>
                                                    <th>{{ $teacherDetails->institype ? $teacherDetails->institype->name : '' }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="text-uppercase">Institution : </td>
                                                    <th>{{ $teacherDetails->honours_institute ? $teacherDetails->honours_institute : $teacherDetails->teacher_university }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="text-uppercase">Background Medium : </td>
                                                    <th>{{ $teacherDetails->honours_curriculam ? $teacherDetails->honours_curriculam : $teacherDetails->teacher_bk_medium }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="text-uppercase">Subject : </td>
                                                    <th>{{ $teacherDetails->honours_subject ? $teacherDetails->honours_subject : $teacherDetails->teacher_subject }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>Qualification/Degree : </td>
                                                    <th>{{ $teacherDetails->studytype ? $teacherDetails->studytype->name : $teacherDetails->teacher_degree }}
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>


                                    <div class="col-md-6">
                                        <table>
                                            <h5 class="py-2"><u>Family Info:</u></h5>

                                            <tbody>
                                                <tr>
                                                    <td class="text-uppercase">Father's Name : </td>
                                                    <th>{{ $teacherDetails->father_name }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="text-uppercase">Father's Phone : </td>
                                                    <th>{{ $teacherDetails->father_phone }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="text-uppercase">Mother's Name : </td>
                                                    <th>{{ $teacherDetails->mother_name }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="text-uppercase">Mother's Phone : </td>
                                                    <th>{{ $teacherDetails->mother_phone }}
                                                    </th>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="col-md-6">
                                        <table>
                                            <h5 class="py-2"><u>Extra Info:</u></h5>

                                            <tbody>
                                                <tr>
                                                    <td class="text-uppercase">Local Guardian's Name : </td>
                                                    <th>{{ $teacherDetails->ex_phone_one }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="text-uppercase">Relation : </td>
                                                    <th>{{ $teacherDetails->ex_phone_two }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="">About him/her : </td>
                                                    <th>{{ $teacherDetails->about_yourself }}
                                                    </th>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>





                                </div>
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
                                        <td><strong>Study Type:</strong>
                                            {{ $teacherDetails->studytype ? $teacherDetails->studytype->name : '' }} <br>
                                            <strong>Institute Type:</strong>
                                            {{ $teacherDetails->institype ? $teacherDetails->institype->name : '' }} <br>
                                            <strong>Institute:</strong> <b>{{ $teacherDetails->honours_institute }}</b>
                                        </td>
                                        <td>{{ $teacherDetails->honours_year }}</td>
                                        <td>{{ $teacherDetails->honours_subject }}</td>
                                        <td>{{ $teacherDetails->honours_curriculam }}</td>
                                        <td>{{ $teacherDetails->honours_gpa }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            @if (isset($teacherDetails->user->verify))
                                <div class="row">
                                    @if ($teacherDetails->user->verify->nid_card)
                                        <div class="col-md-3">
                                            <a href="{{ asset('nid_card/' . $teacherDetails->user->verify->nid_card) }}"
                                                data-lightbox="product-gallery" data-title="">
                                                <img style="width: 100%; height: 250px"
                                                    class="img-responsive img-thumbnail"
                                                    src="{{ isset($teacherDetails->user->verify) ? asset('nid_card/' . $teacherDetails->user->verify->nid_card) : asset('admins/img/nid.jpg') }}"
                                                    title="" />
                                            </a>
                                        </div>
                                    @endif

                                    @if ($teacherDetails->user->verify->student_card)
                                        <div class="col-md-3">
                                            <a href="{{ asset('student_card/' . $teacherDetails->user->verify->student_card) }}"
                                                data-lightbox="product-gallery" data-title="">
                                                <img style="width: 100%; height: 250px"
                                                    class="img-responsive img-thumbnail"
                                                    src="{{ isset($teacherDetails->user->verify) ? asset('student_card/' . $teacherDetails->user->verify->student_card) : asset('admins/img/student.jpg') }}"
                                                    title="" />
                                            </a>
                                        </div>
                                    @endif

                                    @if ($teacherDetails->user->verify->ssc_cft)
                                        <div class="col-md-3">
                                            <a href="{{ asset('ssc_cft/' . $teacherDetails->user->verify->ssc_cft) }}"
                                                data-lightbox="product-gallery" data-title="">
                                                <img style="width: 100%; height: 250px"
                                                    class="img-responsive img-thumbnail"
                                                    src="{{ isset($teacherDetails->user->verify) ? asset('ssc_cft/' . $teacherDetails->user->verify->ssc_cft) : asset('admins/img/student.jpg') }}"
                                                    title="" />
                                            </a>
                                        </div>
                                    @endif

                                    @if ($teacherDetails->user->verify->hsc_cft)
                                        <div class="col-md-3">
                                            <a href="{{ asset('hsc_cft/' . $teacherDetails->user->verify->hsc_cft) }}"
                                                data-lightbox="product-gallery" data-title="">
                                                <img style="width: 100%; height: 250px"
                                                    class="img-responsive img-thumbnail"
                                                    src="{{ isset($teacherDetails->user->verify) ? asset('hsc_cft/' . $teacherDetails->user->verify->hsc_cft) : asset('admins/img/student.jpg') }}"
                                                    title="" />
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif




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
                                    data-href="{{ url('/admin/tutor-list/delete/' . $teacherDetails->user_id) }}"
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


        <div class="alert alert-warning fade show mt-3" role="alert">
            <b class="text-center">
                Review & Ratings
            </b>
        </div>

        <div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="form-tab" data-bs-toggle="tab" data-bs-target="#form"
                        type="button" role="tab" aria-controls="form" aria-selected="true">Add Review</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button"
                        role="tab" aria-controls="list" aria-selected="false">Review List</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="form" role="tabpanel" aria-labelledby="form-tab">


                    <div class="card px-5 py-4">

                        <form id="reviewForm" method="POST" action="{{ url('admin/tutor/submit_review') }}">
                            @csrf
                            <input type="hidden" name="tutor_id" value="{{ $teacherDetails->user_id }}" />
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Rating</label>
                                <div class="col-sm-10">
                                    <div class="star-rating">
                                        <input type="radio" id="star5" name="rating" value="5" />
                                        <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                                        <input type="radio" id="star4" name="rating" value="4" />
                                        <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                                        <input type="radio" id="star3" name="rating" value="3" />
                                        <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                                        <input type="radio" id="star2" name="rating" value="2" />
                                        <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                                        <input type="radio" id="star1" name="rating" value="1" />
                                        <label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="review" class="col-sm-2 col-form-label">Review</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 col-form-label"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary ml-auto">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>



                </div>
                <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                    <h5>Review List</h5>
                    <div class="card ">

                        <div class="table-responsive">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col">Review</th>
                                        <th scope="col">Posted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($review_data as $data)
                                        <tr>
                                            <th scope="row">
                                                @if ($data->student_id == 0)
                                                    <img style="width: 60px; height: 60px" class=""
                                                        src="{{ asset('/favicon.ico') }}" title="" />
                                                @else
                                                    <img style="width: 60px; height: 60px" class=""
                                                        src="{{ asset($data->student ? $data->student->image : '') }}"
                                                        title="" />
                                                @endif
                                            </th>
                                            <td>{{ $data->student ? $data->student->name : 'Tutor Sheba' }}</td>
                                            <td>
                                                @foreach (range(1, $data->rating) as $i)
                                                    <span class="text-warning">
                                                        <i class="fas fa-star"></i>
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td>{{ $data->review }}</td>
                                            <td> {{ $data->created_at->format('d-M-Y') }}</td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

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
