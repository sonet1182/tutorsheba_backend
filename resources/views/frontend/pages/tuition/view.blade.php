@extends('frontend.layouts.master')

@section('content')
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div class="card my-3 tuition-list">
                        <div class="card-body">

                            @if (session('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ session('message') }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('already'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Sorry!</strong> {{ session('already') }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <h2 class="text-center">{{ $tuition->title }}</h2>
                            <p class="text-center"><b>Job ID :</b> {{ $tuition->id }}<span class="m-line"></span> &nbsp;
                                <b>Created Date :</b> {{ $tuition->created_at->format('D M-d-Y') }}</p>



                            <h1 class="text-center"><i class="fa fa-map-marker text-danger" aria-hidden="true"></i></h1>
                            <div class="text-center" style="font-size: 20px">
                                {{ $tuition->districts->districtName }},{{ $tuition->s_area }}</div>


                            <h4 class="text-center mb-5 text-primary">{{ $tuition->t_days }}</h4>

                            <div class="row" style="font-size: 17px">
                                <div class="col-6"><span class="float-right">Class:</span> </div>
                                <div class="col-6"><strong> {{ $tuition->s_class }}</strong></div>
                                <div class="col-6"><span class="float-right">Category:</span> </div>
                                <div class="col-6"><strong> {{ $tuition->s_medium }}</strong></div>
                                <div class="col-6"><span class="float-right">Student Gender:</span> </div>
                                <div class="col-6"><strong> {{ $tuition->s_gender }}</strong></div>
                                <div class="col-6"><span class="float-right">Preferred Tutor:</span> </div>
                                <div class="col-6"><strong> {{ $tuition->t_gender }}</strong></div>
                            </div>

                            <div class="row py-4" style="font-size: 17px">
                                <div class="col-6"><span class="float-right">Tutoring Time :</span> </div>
                                <div class="col-6"><strong>
                                        {{ empty($tuition->time) ? 'Negotiable' : date('g:i a', strtotime($tuition->time)) }}</strong>
                                </div>
                                <div class="col-6"><span class="float-right">Tutoring Days:</span> </div>
                                <div class="col-6"><strong> {{ $tuition->t_days }}</strong></div>
                                <div class="col-6"><span class="float-right">No of Student:</span> </div>
                                <div class="col-6"><strong> {{ $tuition->s_number ? $tuition->s_number : '1' }}</strong>
                                </div>
                            </div>

                            <br>
                            @if ($tuition->t_salary >= 1)
                                <h5 class="text-center" style="font-size: 20px">Salary : <strong
                                        style="font-size: 30px; color: #6c2a8c;">{{ $tuition->t_salary }}</strong> tk</h5>
                            @else
                                <h5 class="text-center" style="font-size: 20px">Salary : <strong
                                        style="font-size: 30px; color: #6c2a8c;">Negotiable</strong></h5>
                            @endif






                            <div class="row">
                                <div class="col-md-9">
                                    <p><b>Other Requirements</b> -{{ $tuition->ex_information }}</p>


                                    <b class="text-primary">Share Now:</b><br>

                                    <i class="fa fa-mobile" aria-hidden="true" data-toggle="modal"
                                        data-target="#exampleModalCenter1"
                                        style="font-size: 30px; cursor: pointer; color: #6c2a8c;"></i>&nbsp; &nbsp;
                                    <i class="fa fa-envelope" aria-hidden="true" data-toggle="modal"
                                        data-target="#exampleModalCenter2"
                                        style="font-size: 30px; cursor: pointer; color: #6c2a8c;"></i>&nbsp; &nbsp;
                                    <i class="fa fa-whatsapp" aria-hidden="true" data-toggle="modal"
                                        data-target="#exampleModalCenter3"
                                        style="font-size: 30px; cursor: pointer; color: #6c2a8c;"></i>



                                </div>




                                <div class="col-md-3 mt-2">

                                    <a href="{{ url('/login') }}" class="btn btn-sm btn-custom text-light mb-2">
                                        Location
                                    </a>

                                    <a href="{{ url('/login') }}" class="btn btn-sm btn-custom text-light mb-2">
                                        Direction
                                    </a>

                                    <p><b>Published Time</b> : {{ $tuition->created_at->diffForHumans() }}</p>

                                    @guest
                                        <a href="{{ url('/login') }}" class="btn btn-outline-primary mb-2 w-100">
                                            <i class="fa fa-send"></i> Login then apply this job
                                        </a>
                                    @else
                                        @if ($prog > 80)
                                            <Form action="{{ url('/teacher_tuition_request') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="student_id" value="{{ $tuition->id }}">
                                                <button type="submit" class="btn btn-outline-primary mb-2 w-100">
                                                    <i class="fa fa-send"></i> apply this job
                                                </button>
                                            </Form>
                                        @else
                                            <h6 class="text-danger">You have to complete minimum 80% of your profile!</h6>
                                            <button type="submit" class="btn btn-outline-primary mb-2 w-100"
                                                style="cursor: not-allowed;" disabled>
                                                <i class="fa fa-send"></i> apply this job
                                            </button>
                                            <a href="{{ url('/edit/profile') }}">Update Profile</a>
                                        @endif
                                    @endguest

                                </div>
                            </div>





                            <!--<div class="sj-bg-icon"><img class="mb-4" src="{{ asset('img/icon/photo-1576675297665.svg') }}" alt=""></div>-->
                        </div>
                    </div>


                    <div class="card mb-2">
                        <a href="/tuition-list" class="btn btn-success text-light">Go Back to All Jobs</a>
                    </div>
                </div>

                <div class="container">
                    <div class="row margin_top_details">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 my-2">
                                    <div class="card job_card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4 class="card-title text-brand">Student Information</h4>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fab fa-gg"></i>
                                                        <div class="content">
                                                            <span>Category</span>
                                                            <h6>Bangla Medium</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fab fa-discourse"></i>
                                                        <div class="content">
                                                            <span>Course</span>
                                                            <h6> Pre-Schooling, </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fas fa-book-reader"></i>
                                                        <div class="content">
                                                            <span>Subjects</span>
                                                            <h6>
                                                                All </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fas fa-bacon"></i>
                                                        <div class="content">
                                                            <span>Days In Week</span>
                                                            <h6>4 Days</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fab fa-cloudscale"></i>
                                                        <div class="content">
                                                            <span>Tutoring Time</span>
                                                            <h6>5:00 PM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                                                        <div class="content">
                                                            <span>Tutoring Duration</span>
                                                            <h6>1.30 Hour</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fas fa-medal"></i>
                                                        <div class="content">
                                                            <span>Tutor Method</span>
                                                            <h6>Student&#039;s Home</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fab fa-google-wallet"></i>
                                                        <div class="content">
                                                            <span>Maximum Salary</span>
                                                            <h6>2000 Tk</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fas fa-user-graduate"></i>
                                                        <div class="content">
                                                            <span>Number Of Student</span>
                                                            <h6>1</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fas fa-venus-mars"></i>
                                                        <div class="content">
                                                            <span>Student Gender</span>
                                                            <h6>female</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-2 sm_d_none">
                            <div class="card right_size_button job_card">
                                <div
                                    class="card-body d-flex flex-column align-items-center justify-content-center details_buttons">
                                    <a href="" class="btn btn_black text-white">Get Direction</a>
                                    <a href="" class="btn text-black mt-2 btn_white">Location</a>
                                    <a class="btn text-black mt-2 btn_white cpy"
                                        data-clipboard-text="https://tuitionterminal.com.bd/job-offers/job-details/18224"
                                        onclick="linkCoppid('The link is copied!')">Copy Link</a>
                                    <a class="btn bg-main-color text-white mt-2" id="nplogin">Apply Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 my-2">
                                    <div class="card job_card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4 class="card-title text-brand">Tutor Requirements</h4>
                                                </div>
                                            </div>
                                            <div class="row mt-4">

                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fas fa-people-carry"></i>
                                                        <div class="content">
                                                            <span>Curriculum</span>
                                                            <h6>Bangla Medium</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fas fa-transgender-alt"></i>
                                                        <div class="content">
                                                            <span>Tutor Gender</span>
                                                            <h6>female</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        <div class="content">
                                                            <span>Hiring From</span>
                                                            <h6>2022-09-12</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12 my-3">
                                                    <div class="first_item">
                                                        <i class="fas fa-recycle"></i>
                                                        <div class="content">
                                                            <span>Other Requirement</span>
                                                            <h6>Responsible &amp; experienced tutors are cordially invited
                                                                to
                                                                apply</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 my-2">
                                    <div class="card job_card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4 class="card-title text-brand">Contact Information</h4>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fas fa-city"></i>
                                                        <div class="content">
                                                            <span>City</span>
                                                            <h6>Dhaka</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        <div class="content">
                                                            <span>Location</span>
                                                            <h6>Mirpur 2</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4 my-3">
                                                    <div class="first_item">
                                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                                        <div class="content">
                                                            <span>Full Address</span>
                                                            <h6>Near Stadium Entry Gate No: 4</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 my-2 job_detils_footer">
                                    <div class="card h-75 job_card">
                                        <div class="card-body d-flex align-items-center justify-content-between mt-4">
                                            <p>JOB ID 18224</p>
                                            <p>TOTAL VIEWS- 1</p>
                                            <p>TOTAL APPLICATIONS- 1</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 my-2 lg_d_none sm_d_block">
                            <div class="card right_size_button job_card">
                                <div
                                    class="card-body d-flex flex-column align-items-center justify-content-center details_buttons">
                                    <a href="" class="btn btn_black text-white">Get Direction</a>
                                    <a href="" class="btn text-black mt-2 btn_white">Location</a>
                                    <a class="btn text-black mt-2 btn_white cpy"
                                        data-clipboard-text="https://tuitionterminal.com.bd/job-offers/job-details/18224"
                                        onclick="linkCoppid('The link is copied!')">Copy Link</a>
                                    <a class="btn bg-main-color text-white mt-2" id="nplogin">Apply Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
