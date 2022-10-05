<div class="col-xl-3 col-lg-4">
    <div class="right_side">

        @if(Auth::user())
        <div class="fcrse_2 mb-30">
            <div class="tutor_img">
                <a href="my_instructor_profile_view.html">
                    @if(Auth::user())
                    <img src="{{ asset(Auth::user()->teacher->teacher_profile_picture) }}" alt="" onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/data/icons/instagram-ui-twotone/48/Paul-18-512.png';">
                    @else
                    <img src="/assets/images/left-imgs/img-1.jpg" alt="">
                    @endif
                </a>
            </div>
            <div class="tutor_content_dt">
                <div class="tutor150">
                    <a href="my_instructor_profile_view.html" class="tutor_name">Shawn Shikder</a>
                    <div class="mef78" title="Verify">
                        <i class="uil uil-check-circle"></i>
                    </div>
                </div>


                <div class="tutor_cate">{{ Auth::user()->teacher->teacher_university }}</div>
                <div class="tut1250">
                    <h4>{{ Auth::user()->teacher->teacher_subject }}</h4>
                    <span class="vdt15">{{ Auth::user()->teacher->districts ? Auth::user()->teacher->districts->districtName : '' }}
                        </span>
                </div>

                <ul class="tutor_social_links">
                    <li><a href="#" class="fb"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li><a href="#" class="tw"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li><a href="#" class="ln"><i
                                class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="#" class="yu"><i class="fab fa-youtube"></i></a>
                    </li>
                </ul>
                <div class="tut1250">
                    <span class="vdt15">615K Students</span>
                    <span class="vdt15">12 Courses</span>
                </div>
                <a href="{{ route('tutor.dashboard') }}" class="prfle12link">Go To Profile</a>
            </div>
        </div>
        @endif

        <div class="fcrse_3">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-purple">
                        SEARCH FOR TUTORS
                    </h3>
                    <h5>
                        Find the right tutor, in your area
                    </h5>
                </div>
                <div class="card-body">
                    {{-- {!! Form::open(['url' => '/search-tutor','method'=>'GET','class'=>'search-form']) !!} --}}
                    <form action="{{ url('/search-tutor') }}" class="search-form" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <select  name="districts" class="form-control districts single-select">
                                    <option value="">Select Districts</option>
                                    @foreach($allDistrict as $districts)
                                    <option value="{{ $districts->id }}">{{ $districts->districtName }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div name="area" class="form-group col-md-12">
                                <div class="selectArea">
                                    <select name="area" class="form-control area single-select">
                                        <option value="">Select Area</option>
                                    </select>
                                </div>
                                <div class="loadingImgArea" style="display: none;">
                                    <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}" alt="TutorSheba" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <select name="medium" class="form-control medium single-select">
                                    <option value="">Select Medium</option>
                                    @foreach($allMedium as $medium)
                                        <option value="{{ $medium->mediumName }}">{{ $medium->mediumName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div name="class" class="form-group col-md-12">
                                <div class="selectClass">
                                    <select name="class" class="form-control class single-select">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                                <div class="loadingImgClass" style="display: none;">
                                    <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}" alt="TutorSheba" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div name="subject" class="form-group col-md-12">
                                <div class="selectSubject">
                                    <select name="subject" class="form-control subject single-select">
                                        <option value="">Select Subject</option>
                                    </select>
                                </div>
                                <div class="loadingImgSubject" style="display: none;">
                                    <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}" alt="TutorSheba" />
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <select name="gender" class="form-control single-select">
                                    <option value="">Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm px-3 btn-primary btn-block">Search For Tutor</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="fcrse_3">
            <div class="cater_ttle">
                <h4>Live Streaming</h4>
            </div>
            <div class="live_text">
                <div class="live_icon"><i class="uil uil-kayak"></i></div>
                <div class="live-content">
                    <p>Set up your channel and stream live to your students</p>
                    <button class="live_link"
                        onclick="window.location.href = 'add_streaming.html';">Get
                        Started</button>
                    <span class="livinfo">Info : This feature only for 'Instructors'.</span>
                </div>
            </div>
        </div>
        <div class="get1452">
            <h4>Get personalized recommendations</h4>
            <p>Answer a few questions for your top picks</p>
            <button class="Get_btn" onclick="window.location.href = '#';">Get Started</button>
        </div>
        <div class="fcrse_3">
            <div class="cater_ttle">
                <h4>Top Categories</h4>
            </div>
            <ul class="allcate15">
                <li><a href="#" class="ct_item"><i
                            class='uil uil-arrow'></i>Development</a></li>
                <li><a href="#" class="ct_item"><i
                            class='uil uil-graph-bar'></i>Business</a></li>
                <li><a href="#" class="ct_item"><i class='uil uil-monitor'></i>IT and
                        Software</a></li>
                <li><a href="#" class="ct_item"><i class='uil uil-ruler'></i>Design</a>
                </li>
                <li><a href="#" class="ct_item"><i
                            class='uil uil-chart-line'></i>Marketing</a></li>
                <li><a href="#" class="ct_item"><i
                            class='uil uil-book-open'></i>Personal Development</a></li>
                <li><a href="#" class="ct_item"><i
                            class='uil uil-camera'></i>Photography</a></li>
                <li><a href="#" class="ct_item"><i class='uil uil-music'></i>Music</a>
                </li>
            </ul>
        </div>
        <div class="strttech120">
            <h4>Become an Instructor</h4>
            <p>Top instructors from around the world teach millions of students on Cursus. We
                provide the tools and skills to teach what you love.</p>
            <button class="Get_btn" onclick="window.location.href = '#';">Start
                Teaching</button>
        </div>
    </div>
</div>
