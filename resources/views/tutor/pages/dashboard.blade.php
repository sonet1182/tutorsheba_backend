@extends('frontend.layouts.master')

@section('content')
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="st_title"><i class="uil uil-apps"></i> Instructor Dashboard</h2>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="card_dash">
                        <div class="card_dash_left">
                            <h5>Total Sales</h5>
                            <h2>$350</h2>
                            <span class="crdbg_1">New $50</span>
                        </div>
                        <div class="card_dash_right">
                            <img src="/assets/images/dashboard/achievement.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="card_dash">
                        <div class="card_dash_left">
                            <h5>Total Enroll</h5>
                            <h2>1500</h2>
                            <span class="crdbg_2">New 125</span>
                        </div>
                        <div class="card_dash_right">
                            <img src="/assets/images/dashboard/graduation-cap.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="card_dash">
                        <div class="card_dash_left">
                            <h5>Total Courses</h5>
                            <h2>130</h2>
                            <span class="crdbg_3">New 5</span>
                        </div>
                        <div class="card_dash_right">
                            <img src="/assets/images/dashboard/online-course.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="card_dash">
                        <div class="card_dash_left">
                            <h5>Total Students</h5>
                            <h2>2650</h2>
                            <span class="crdbg_4">New 245</span>
                        </div>
                        <div class="card_dash_right">
                            <img src="/assets/images/dashboard/knowledge.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card_dash1">
                        <div class="card_dash_left1">
                            <i class="uil uil-book-alt"></i>
                            <h1>Apply Status</h1>
                        </div>
                        <div class="card_dash_right1">
                            <button class="create_btn_dash"
                                onclick="window.location.href = 'create_new_course.html';">Create Your
                                Course</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 row card_dash1">

                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="{{ url('/my/apply_tuition_list') }}" class="card border-left-info shadow h-100 py-2">
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
                        <a href="{{ url('/my/assigned_tuition_list') }}" class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assigned Jobs
                                        </div>
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
                        <a href="{{ url('/my/confirmed_tuition_list') }}" class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Confirmed Jobs
                                        </div>
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
                        <a href="{{ url('/my/cancelled_tuition_list') }}" class="card shadow h-100 py-2"
                            style="border-left: 4px solid #eb3933;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cancelled Jobs
                                        </div>
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
            </div>



            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="section3125 mt-50">
                        <h4 class="item_title">Latest Courses performance</h4>
                        <div class="la5lo1">
                            <div class="owl-carousel courses_performance owl-theme">
                                <div class="item">
                                    <div class="fcrse_1">
                                        <a href="#" class="fcrse_img">
                                            <img src="/assets/images/courses/img-1.jpg" alt="">
                                            <div class="course-overlay"></div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="vdtodt">
                                                <span class="vdt14">First 2 days 22 hours</span>
                                            </div>
                                            <a href="#" class="crsedt145">Complete Python Bootcamp: Go from
                                                zero to hero in Python 3</a>
                                            <div class="allvperf">
                                                <div class="crse-perf-left">View</div>
                                                <div class="crse-perf-right">1.5k</div>
                                            </div>
                                            <div class="allvperf">
                                                <div class="crse-perf-left">Purchased</div>
                                                <div class="crse-perf-right">150</div>
                                            </div>
                                            <div class="allvperf">
                                                <div class="crse-perf-left">Total Like</div>
                                                <div class="crse-perf-right">1k</div>
                                            </div>
                                            <div class="auth1lnkprce">
                                                <a href="#" class="cr1fot50">Go to course analytics</a>
                                                <a href="#" class="cr1fot50">See comments (875)</a>
                                                <a href="#" class="cr1fot50">See Reviews (105)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_1">
                                        <a href="#" class="fcrse_img">
                                            <img src="/assets/images/courses/img-2.jpg" alt="">
                                            <div class="course-overlay"></div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="vdtodt">
                                                <span class="vdt14">Second 4 days 9 hours</span>
                                            </div>
                                            <a href="#" class="crse14s">The Complete JavaScript Course 2020:
                                                Build Real Projects!</a>
                                            <div class="allvperf">
                                                <div class="crse-perf-left">View</div>
                                                <div class="crse-perf-right">175k</div>
                                            </div>
                                            <div class="allvperf">
                                                <div class="crse-perf-left">Purchased</div>
                                                <div class="crse-perf-right">1k</div>
                                            </div>
                                            <div class="allvperf">
                                                <div class="crse-perf-left">Total Like</div>
                                                <div class="crse-perf-right">85k</div>
                                            </div>
                                            <div class="auth1lnkprce">
                                                <a href="#" class="cr1fot50">Go to course analytics</a>
                                                <a href="#" class="cr1fot50">See comments (915)</a>
                                                <a href="#" class="cr1fot50">See Reviews (255)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_1">
                                        <a href="#" class="fcrse_img">
                                            <img src="/assets/images/courses/img-3.jpg" alt="">
                                            <div class="course-overlay"></div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="vdtodt">
                                                <span class="vdt14">Third 6 days 11 hours:</span>
                                            </div>
                                            <a href="#" class="crse14s">Beginning C++ Programming - From
                                                Beginner to Beyond</a>
                                            <div class="allvperf">
                                                <div class="crse-perf-left">View</div>
                                                <div class="crse-perf-right">17k</div>
                                            </div>
                                            <div class="allvperf">
                                                <div class="crse-perf-left">Purchased</div>
                                                <div class="crse-perf-right">25</div>
                                            </div>
                                            <div class="allvperf">
                                                <div class="crse-perf-left">Total Like</div>
                                                <div class="crse-perf-right">15k</div>
                                            </div>
                                            <div class="auth1lnkprce">
                                                <a href="#" class="cr1fot50">Go to course analytics</a>
                                                <a href="#" class="cr1fot50">See comments (155)</a>
                                                <a href="#" class="cr1fot50">See Reviews (15)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="section3125 mt-50">
                        <h4 class="item_title">News</h4>
                        <div class="la5lo1">
                            <div class="owl-carousel edututs_news owl-theme">
                                <div class="item">
                                    <div class="fcrse_1">
                                        <a href="#" class="fcrse_img">
                                            <img src="/assets/images/courses/news-1.jpg" alt="">
                                        </a>
                                        <div class="fcrse_content">
                                            <a href="#" class="crsedt145 mt-15">COVID-19 Updates &
                                                Resources</a>
                                            <p class="news_des45">See the latest updates to coronavirus-related
                                                content, including changes to monetization, and access new Creator
                                                support resources</p>
                                            <div class="auth1lnkprce">
                                                <a href="#" class="cr1fot50">Learn More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_1">
                                        <a href="#" class="fcrse_img">
                                            <img src="/assets/images/courses/news-2.jpg" alt="">
                                        </a>
                                        <div class="fcrse_content">
                                            <a href="#" class="crsedt145 mt-15">Watch: Edututs+ interview
                                                Mr. Joginder</a>
                                            <p class="news_des45">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Aenean ac eleifend ante. Duis ac pulvinar felis.
                                                Sed a nibh ligula. Mauris eget tortor id mauris tristique accumsan.
                                            </p>
                                            <div class="auth1lnkprce">
                                                <a href="#" class="cr1fot50">Watch Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_1">
                                        <a href="#" class="fcrse_img">
                                            <img src="/assets/images/courses/news-1.jpg" alt="">
                                        </a>
                                        <div class="fcrse_content">
                                            <a href="#" class="crsedt145 mt-15">COVID-19 Updates - April
                                                7</a>
                                            <p class="news_des45">Ut porttitor mi vel orci cursus, nec elementum
                                                neque malesuada. Phasellus imperdiet quam gravida pharetra aliquet.
                                                Integer vel ligula eget nisl dignissim hendrerit.</p>
                                            <div class="auth1lnkprce">
                                                <a href="#" class="cr1fot50">Learn More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="section3125 mt-50">
                        <h4 class="item_title">Profile Analytics</h4>
                        <div class="la5lo1">
                            <div class="fcrse_1">
                                <div class="fcrse_content">
                                    <h6 class="crsedt8145">Current subscribers</h6>
                                    <h3 class="subcribe_title">856</h3>
                                    <div class="allvperf">
                                        <div class="crse-perf-left">View</div>
                                        <div class="crse-perf-right">17k<span class="analyics_pr"><i
                                                    class="uil uil-arrow-to-bottom"></i>75%</span></div>
                                    </div>
                                    <div class="allvperf">
                                        <div class="crse-perf-left">Purchased<span class="per_text">(per
                                                hour)</span></div>
                                        <div class="crse-perf-right">1<span class="analyics_pr"><i
                                                    class="uil uil-top-arrow-from-top"></i>100%</span></div>
                                    </div>
                                    <div class="allvperf">
                                        <div class="crse-perf-left">Enroll<span class="per_text">(per hour)</span>
                                        </div>
                                        <div class="crse-perf-right">50<span class="analyics_pr"><i
                                                    class="uil uil-top-arrow-from-top"></i>70%</span></div>
                                    </div>
                                    <div class="auth1lnkprce">
                                        <a href="#" class="cr1fot50">Go to profile analytics</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section3125 mt-50">
                        <h4 class="item_title">Submit Courses</h4>
                        <div class="la5lo1">
                            <div class="fcrse_1">
                                <div class="fcrse_content">
                                    <div class="upcming_card">
                                        <a href="#" class="crsedt145">The Complete JavaScript Course 2020:
                                            Build Real Projects!<span class="pndng_145">Pending</span></a>
                                        <p class="submit-course">Submitted<span>1 days ago</span></p>
                                        <a href="#" class="delete_link10">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section3125 mt-50">
                        <h4 class="item_title">What's new in Edututs+</h4>
                        <div class="la5lo1">
                            <div class="fcrse_1">
                                <div class="fcrse_content">
                                    <a href="#" class="new_links10">Improved performance on Studio
                                        Dashboard</a>
                                    <a href="#" class="new_links10">See more Dashboard updates</a>
                                    <a href="#" class="new_links10">See issues-at-glance for Live</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- @include('frontend.layouts.rightSidebar') --}}
    </div>
@endsection
