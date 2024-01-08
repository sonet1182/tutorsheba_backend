@extends('admin.master')
@section('title', 'Admin | TutorSheba.com')


@section('content')
    <div class="page-content fade-in-up">

        <div class="row">
            <a href="{{ url('/admin/new_teacher_request') }}" class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $tutor }}</h2>
                        <div class="m-b-5">Total Tutor</div><i class="ti-shopping-cart widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small>25% higher</small></div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/new_student_request') }}" class="col-lg-3 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $student }}</h2>
                        <div class="m-b-5">Total Tuition</div><i class="ti-bar-chart widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small>17% higher</small></div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/approval_student_list') }}" class="col-lg-3 col-md-6">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $approval_studentProfile }}</h2>
                        <div class="m-b-5">Approval Tuition List</div><i class="ti-list widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/student_tutor_request') }}" class="col-lg-3 col-md-6">
                <div class="ibox bg-primary color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $studentRequest }}</h2>
                        <div class="m-b-5">Student Request</div><i class="ti-user widget-stat-icon"></i>
                        <div><i class="fa fa-level-down m-r-5"></i><small>-12% Lower</small></div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/teacher_tuition_request') }}" class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $tutorRequest }}</h2>
                        <div class="m-b-5">Tutor Request</div><i class="ti-money widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/uddokta_list') }}" class="col-lg-3 col-md-6">
                <div class="ibox bg-secondary color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $uddokta }}</h2>
                        <div class="m-b-5">Total Uddokta</div><i class="ti-hand-open widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small>32% higher</small></div>
                    </div>
                </div>
            </a>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="alert bg-white">
                    <h4 class="text-center">Search For Tutor</h4>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Advanced Search</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ url('admin/search/results') }}" method="POST">
                            @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <select class="form-control district" name="districts">
                                    <option value="">Select Districts</option>
                                    @foreach ($allDistrict as $district)
                                        <option value="{{ $district->id }}">{{ $district->districtName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="selectArea">
                                    <select name="area" class="form-control area" id="area">
                                        <option value="">Select Area</option>
                                    </select>
                                </div>
                                <div class="loadingImgArea" style="display: none;">
                                    <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}"
                                        alt="TutorSheba" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <select name="medium" class="form-control medium single-select">
                                    <option value="">Select Medium</option>
                                    @foreach ($allMedium as $medium)
                                        <option value="{{ $medium->mediumName }}">{{ $medium->mediumName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div name="class" class="form-group col-md-6">
                                <div class="selectClass">
                                    <select name="class" class="form-control class single-select">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                                <div class="loadingImgClass" style="display: none;">
                                    <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}"
                                        alt="TutorSheba" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div name="subject" class="form-group col-md-6">
                                <div class="selectSubject">
                                    <select name="subject" class="form-control subject single-select">
                                        <option value="">Select Subject</option>
                                    </select>
                                </div>
                                <div class="loadingImgSubject" style="display: none;">
                                    <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}"
                                        alt="TutorSheba" />
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <select class="form-control gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div name="subject" class="form-group col-md-6">
                                <div class="selectSubject">
                                    <label>Enter University</label>
                                    <input type="text" class="form-control" name="university" placeholder="Serch by Typing..."/>
                                </div>
                                <div class="loadingImgSubject" style="display: none;">
                                    <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}"
                                        alt="TutorSheba" />
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Enter Subject</label>
                                <input type="text" class="form-control" name="t_subject" placeholder="Serch by Typing..."/>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success"><i class="fa fa-search fa-lg"></i> SEARCH FOR
                            TUTORS</button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="alart" class="col-lg-3">
                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Specifics Search</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ url('/admin/search/name') }}" method="POST">
                            @csrf
                        <div class="form-group">
                            <label>Search for Tutor Name</label>
                            <div class="input-group">
                                <input class="form-control" name="name" type="text" placeholder="Tutor Name">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Go!</button>
                                </div>
                            </div>
                        </div>
                    </form>

                        <form action="{{ url('/admin/search/email-address') }}" method="POST">
                            @csrf
                        <div class="form-group">
                            <label>Search for Email Address</label>
                            <div class="input-group">
                                <input class="form-control" name="email" type="text" placeholder="Email Address">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Go!</button>
                                </div>
                            </div>
                        </div>
                    </form>
                        @if (session('AlertErrorMessage2'))
                            <div class="alert alert-success text-center">
                                <h6 class="text-danger">{{ session('AlertErrorMessage2') }}</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div id="alart1" class="col-lg-3">
                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Specifics Search</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ url('/admin/search/id') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Search for Tutor Id</label>
                                <div class="input-group">
                                    <input class="form-control" name="id" type="text" placeholder="Tutor Id">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary" type="submit">Go!</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <form action="{{ url('/admin/search/phone-number') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Search for phone Number</label>
                                <div class="input-group">
                                    <input class="form-control" name="phoneNumber" type="text"
                                        placeholder="Phone Number">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary" type="submit">Go!</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if (session('AlertErrorMessage1'))
                            <div class="alert alert-success text-center">
                                <h6 class="text-danger">{{ session('AlertErrorMessage1') }}</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="alart2" class="col-lg-12">
                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Search by Edu Info:</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ url('/admin/search-by-edu-info/results') }}" method="POST">
                            @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <select class="form-control instiTypes single-select" name="instiTypes">
                                    <option value="">Select Institue Type:</option>
                                    @foreach ($instiTypes as $instiType)
                                        <option value="{{ $instiType->id }}">{{ $instiType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="selectInsti">
                                    <select name="institute" class="form-control institute single-select" id="institute">
                                        <option value="">Select Institute</option>
                                    </select>
                                </div>
                                <div class="loadingImgInstiType" style="display: none;">
                                    <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}"
                                        alt="TutorSheba" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <select name="studyTypes" class="form-control studyTypes single-select">
                                    <option value="">Select Study Type</option>
                                    @foreach ($studyTypes as $studyType)
                                        <option value="{{ $studyType->id }}">{{ $studyType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div name="class" class="form-group col-md-6">
                                <div class="selectDepartments">
                                    <select name="departments" class="form-control departments single-select">
                                        <option value="">Select Departments/Subject</option>
                                    </select>
                                </div>
                                <div class="loadingImgDepartmets" style="display: none;">
                                    <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}"
                                        alt="TutorSheba" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <select class="form-control curciculam" name="curciculam">
                                    <option value="">Select Curriculum:</option>
                                    <option value="Bangla Version">Bangla Version</option>
                                    <option value="English Version">English Version</option>
                                    <option value="Ed-Excel">Ed-Excel</option>
                                    <option value="Cambridge">Cambridge</option>
                                    <option value="IB">IB</option>
                                </select>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-success"><i class="fa fa-search fa-lg"></i> SEARCH</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-body">
                        <div class="flexbox mb-4">
                            <div>
                                <h3 class="m-0">Statistics</h3>
                                <div>Your shop sales analytics</div>
                            </div>
                            <div class="d-inline-flex">
                                <div class="px-3" style="border-right: 1px solid rgba(0,0,0,.1);">
                                    <div class="text-muted">WEEKLY INCOME</div>
                                    <div>
                                        <span class="h2 m-0">$850</span>
                                        <span class="text-success ml-2"><i class="fa fa-level-up"></i> +25%</span>
                                    </div>
                                </div>
                                <div class="px-3">
                                    <div class="text-muted">WEEKLY SALES</div>
                                    <div>
                                        <span class="h2 m-0">240</span>
                                        <span class="text-warning ml-2"><i class="fa fa-level-down"></i> -12%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <canvas id="bar_chart" style="height:300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Statistics</div>
                    </div>
                    <div class="ibox-body">
                        <ul class="list-group list-group-divider list-group-full">
                            <li class="list-group-item">Dhaka
                                <span
                                    class="float-right text-info">{{ \App\Models\TeacherProfile::where('district_id', 3)->count() }}</span>
                            </li>
                            <li class="list-group-item">Chattogram
                                <span
                                    class="float-right text-info">{{ \App\Models\TeacherProfile::where('district_id', 4)->count() }}</span>
                            </li>
                            <li class="list-group-item">Rajshahi
                                <span
                                    class="float-right text-info">{{ \App\Models\TeacherProfile::where('district_id', 5)->count() }}</span>
                            </li>
                            <li class="list-group-item">Sylhet
                                <span
                                    class="float-right text-info">{{ \App\Models\TeacherProfile::where('district_id', 6)->count() }}</span>
                            </li>
                            <li class="list-group-item">Khulna
                                <span
                                    class="float-right text-info">{{ \App\Models\TeacherProfile::where('district_id', 7)->count() }}</span>
                            </li>
                            <li class="list-group-item">Barisal
                                <span
                                    class="float-right text-info">{{ \App\Models\TeacherProfile::where('district_id', 8)->count() }}</span>
                            </li>
                            <li class="list-group-item">Rangpur
                                <span
                                    class="float-right text-info">{{ \App\Models\TeacherProfile::where('district_id', 9)->count() }}</span>
                            </li>
                            <li class="list-group-item">Mymensingh
                                <span
                                    class="float-right text-info">{{ \App\Models\TeacherProfile::where('district_id', 10)->count() }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
