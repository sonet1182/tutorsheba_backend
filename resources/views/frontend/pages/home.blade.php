@extends('frontend.layouts.master')

@section('content')
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">


                <div class="col-xl-9 col-lg-8">
                    @include('frontend.components.banner', ['banners' => $banners])
                    <div class="section3125 mt-4">
                        <h4 class="item_title">Find your subject experts</h4>
                        <a href="live_streams.html" class="see150">See all</a>
                        @include('frontend.components.subject')
                    </div>

                    <div class="section3125 mt-50">
                        <h4 class="item_title">Featured Tutors</h4>
                        <a href="{{ route('featured') }}" class="see150">See all</a>
                        <div class="la5lo1">
                            <div class="owl-carousel top_instrutors owl-theme">
                                @include('frontend.components.tutorbox', ['tutors' => $tutors])
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <h4 class="text-title">RECENT TUITION JOB
                                <a href="{{ url('/tuition-list') }}" class="btn btn-sm btn-custom text-light">
                                    View More
                                </a>
                            </h4>
                            <!--<div class="owl-carousel owl-one">-->
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($studentProfile as $tuition)
                                        <div
                                            class="card my-4 tuition-list carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <div class="card-body recent_tutor">
                                                <button class="btn btn-sm btn-danger text-light px-3">Job
                                                    ID-{{ $tuition->id }}</button>
                                                <h3 class="t_title">{{ $tuition->title }}</h3>
                                                <div class="form-row pb-1">
                                                    <div class="col-md-4" style="font-size: 15px">
                                                        <b class="text-primary">Category :</b> {{ $tuition->s_medium }}
                                                    </div>
                                                    <div class="col-md-4" style="font-size: 15px">
                                                        <b class="text-primary">Class :</b> {{ $tuition->s_class }}
                                                    </div>
                                                    <div class="col-md-4" style="font-size: 15px">
                                                        <b class="text-primary">Salary :</b>
                                                        {{ number_format((int) $tuition->t_salary) }} BDT
                                                    </div>
                                                </div>
                                                <span><b>Subjects :</b> {{ $tuition->t_subject }}</span>
                                                <br><b>{{ $tuition->t_days }} </b>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div>
                                                            <h4 class="py-3"><i class="fa fa-map-marker text-primary"></i>
                                                                {{ $tuition->districts->districtName }},{{ $tuition->s_area }}
                                                            </h4>
                                                        </div>
                                                        <p class="">Other Requirements -
                                                            {{ $tuition->ex_information }}.</p>
                                                    </div>
                                                    <div class="col-md-4 mt-2">
                                                        <div>
                                                            <a href="/tuition-list/view/{{ $tuition->id }}"
                                                                class="btn btn-sm btn-info text-light">
                                                                <i class="fa fa-link"></i> More details
                                                            </a>
                                                        </div>
                                                        <small>Published Time:
                                                            {{ $tuition->created_at->diffForHumans() }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev recent_tutor" href="#carouselExampleControls" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next recent_tutor" href="#carouselExampleControls" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="section3125 mt-50">
                        <h4 class="item_title">Featured Courses</h4>
                        <a href="#" class="see150">See all</a>
                        <div class="la5lo1">
                            <div class="owl-carousel featured_courses owl-theme">
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <a href="course_detail_view.html" class="fcrse_img">
                                            <img src="/assets/images/courses/img-1.jpg" alt="">
                                            <div class="course-overlay">
                                                <div class="badge_seller">Bestseller</div>
                                                <div class="crse_reviews">
                                                    <i class='uil uil-star'></i>4.5
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <div class="crse_timer">
                                                    25 hours
                                                </div>
                                            </div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="eps_dots more_dropdown">
                                                <a href="#"><i class='uil uil-ellipsis-v'></i></a>
                                                <div class="dropdown-content">
                                                    <span><i class='uil uil-share-alt'></i>Share</span>
                                                    <span><i class="uil uil-heart"></i>Save</span>
                                                    <span><i class='uil uil-ban'></i>Not Interested</span>
                                                    <span><i class="uil uil-windsock"></i>Report</span>
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">109k views</span>
                                                <span class="vdt14">15 days ago</span>
                                            </div>
                                            <a href="course_detail_view.html" class="crse14s">Complete Python
                                                Bootcamp: Go from zero to hero in Python 3</a>
                                            <a href="#" class="crse-cate">Web Development | Python</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot">By <a href="#">John Doe</a></p>
                                                <div class="prce142">$10</div>
                                                <button class="shrt-cart-btn" title="cart"><i
                                                        class="uil uil-shopping-cart-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <a href="course_detail_view.html" class="fcrse_img">
                                            <img src="/assets/images/courses/img-2.jpg" alt="">
                                            <div class="course-overlay">
                                                <div class="badge_seller">Bestseller</div>
                                                <div class="crse_reviews">
                                                    <i class='uil uil-star'></i>4.5
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <div class="crse_timer">
                                                    28 hours
                                                </div>
                                            </div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="eps_dots more_dropdown">
                                                <a href="#"><i class='uil uil-ellipsis-v'></i></a>
                                                <div class="dropdown-content">
                                                    <span><i class='uil uil-share-alt'></i>Share</span>
                                                    <span><i class="uil uil-heart"></i>Save</span>
                                                    <span><i class='uil uil-ban'></i>Not Interested</span>
                                                    <span><i class="uil uil-windsock"></i>Report</span>
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">5M views</span>
                                                <span class="vdt14">15 days ago</span>
                                            </div>
                                            <a href="course_detail_view.html" class="crse14s">The Complete
                                                JavaScript Course 2020: Build Real Projects!</a>
                                            <a href="#" class="crse-cate">Development | JavaScript</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot">By <a href="#">Jassica William</a></p>
                                                <div class="prce142">$5</div>
                                                <button class="shrt-cart-btn" title="cart"><i
                                                        class="uil uil-shopping-cart-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <a href="course_detail_view.html" class="fcrse_img">
                                            <img src="/assets/images/courses/img-3.jpg" alt="">
                                            <div class="course-overlay">
                                                <div class="badge_seller">Bestseller</div>
                                                <div class="crse_reviews">
                                                    <i class='uil uil-star'></i>4.5
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <div class="crse_timer">
                                                    12 hours
                                                </div>
                                            </div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="eps_dots more_dropdown">
                                                <a href="#"><i class='uil uil-ellipsis-v'></i></a>
                                                <div class="dropdown-content">
                                                    <span><i class='uil uil-share-alt'></i>Share</span>
                                                    <span><i class="uil uil-heart"></i>Save</span>
                                                    <span><i class='uil uil-ban'></i>Not Interested</span>
                                                    <span><i class="uil uil-windsock"></i>Report</span>
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">1M views</span>
                                                <span class="vdt14">18 days ago</span>
                                            </div>
                                            <a href="course_detail_view.html" class="crse14s">Beginning C++
                                                Programming - From Beginner to Beyond</a>
                                            <a href="#" class="crse-cate">Development | C++</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot">By <a href="#">Joginder Singh</a></p>
                                                <div class="prce142">$13</div>
                                                <button class="shrt-cart-btn" title="cart"><i
                                                        class="uil uil-shopping-cart-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <a href="course_detail_view.html" class="fcrse_img">
                                            <img src="/assets/images/courses/img-4.jpg" alt="">
                                            <div class="course-overlay">
                                                <div class="badge_seller">Bestseller</div>
                                                <div class="crse_reviews">
                                                    <i class='uil uil-star'></i>5.0
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <div class="crse_timer">
                                                    1 hour
                                                </div>
                                            </div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="eps_dots more_dropdown">
                                                <a href="#"><i class='uil uil-ellipsis-v'></i></a>
                                                <div class="dropdown-content">
                                                    <span><i class='uil uil-share-alt'></i>Share</span>
                                                    <span><i class="uil uil-heart"></i>Save</span>
                                                    <span><i class='uil uil-ban'></i>Not Interested</span>
                                                    <span><i class="uil uil-windsock"></i>Report</span>
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">153k views</span>
                                                <span class="vdt14">3 months ago</span>
                                            </div>
                                            <a href="course_detail_view.html" class="crse14s">The Complete Digital
                                                Marketing Course - 12 Courses in 1</a>
                                            <a href="#" class="crse-cate">Digital Marketing | Marketing</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot">By <a href="#">Poonam Verma</a></p>
                                                <div class="prce142">$12</div>
                                                <button class="shrt-cart-btn" title="cart"><i
                                                        class="uil uil-shopping-cart-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <a href="course_detail_view.html" class="fcrse_img">
                                            <img src="/assets/images/courses/img-5.jpg" alt="">
                                            <div class="course-overlay">
                                                <div class="badge_seller">Bestseller</div>
                                                <div class="crse_reviews">
                                                    <i class='uil uil-star'></i>4.5
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <div class="crse_timer">
                                                    1.5 hours
                                                </div>
                                            </div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="eps_dots more_dropdown">
                                                <a href="#"><i class='uil uil-ellipsis-v'></i></a>
                                                <div class="dropdown-content">
                                                    <span><i class='uil uil-share-alt'></i>Share</span>
                                                    <span><i class="uil uil-heart"></i>Save</span>
                                                    <span><i class='uil uil-ban'></i>Not Interested</span>
                                                    <span><i class="uil uil-windsock"></i>Report</span>
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">53k views</span>
                                                <span class="vdt14">14 days ago</span>
                                            </div>
                                            <a href="course_detail_view.html" class="crse14s">Microsoft Excel -
                                                Excel from Beginner to Advanced</a>
                                            <a href="#" class="crse-cate">Office Productivity | Excel</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot">By <a href="#">Rock William</a></p>
                                                <div class="prce142">$6</div>
                                                <button class="shrt-cart-btn" title="cart"><i
                                                        class="uil uil-shopping-cart-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <a href="course_detail_view.html" class="fcrse_img">
                                            <img src="/assets/images/courses/img-6.jpg" alt="">
                                            <div class="course-overlay">
                                                <div class="badge_seller">Bestseller</div>
                                                <div class="crse_reviews">
                                                    <i class='uil uil-star'></i>5.0
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <div class="crse_timer">
                                                    36 hours
                                                </div>
                                            </div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="eps_dots more_dropdown">
                                                <a href="#"><i class='uil uil-ellipsis-v'></i></a>
                                                <div class="dropdown-content">
                                                    <span><i class='uil uil-share-alt'></i>Share</span>
                                                    <span><i class="uil uil-heart"></i>Save</span>
                                                    <span><i class='uil uil-ban'></i>Not Interested</span>
                                                    <span><i class="uil uil-windsock"></i>Report</span>
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">253k views</span>
                                                <span class="vdt14">10 days ago</span>
                                            </div>
                                            <a href="course_detail_view.html" class="crse14s">Angular 8 - The
                                                Complete Guide (2020 Edition)</a>
                                            <a href="#" class="crse-cate">Development | Angular</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot">By <a href="#">John Doe</a></p>
                                                <div class="prce142">$15</div>
                                                <button class="shrt-cart-btn" title="cart"><i
                                                        class="uil uil-shopping-cart-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <a href="course_detail_view.html" class="fcrse_img">
                                            <img src="/assets/images/courses/img-7.jpg" alt="">
                                            <div class="course-overlay">
                                                <div class="badge_seller">Bestseller</div>
                                                <div class="crse_reviews">
                                                    <i class='uil uil-star'></i>5.0
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <div class="crse_timer">
                                                    5.4 hours
                                                </div>
                                            </div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="eps_dots more_dropdown">
                                                <a href="#"><i class='uil uil-ellipsis-v'></i></a>
                                                <div class="dropdown-content">
                                                    <span><i class='uil uil-share-alt'></i>Share</span>
                                                    <span><i class="uil uil-heart"></i>Save</span>
                                                    <span><i class='uil uil-ban'></i>Not Interested</span>
                                                    <span><i class="uil uil-windsock"></i>Report</span>
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">109k views</span>
                                                <span class="vdt14">15 days ago</span>
                                            </div>
                                            <a href="course_detail_view.html" class="crse14s">WordPress for
                                                Beginners: Create a Website Step by Step</a>
                                            <a href="#" class="crse-cate">Design | Wordpress</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot">By <a href="#">Sabnam SIngh</a></p>
                                                <div class="prce142">$18</div>
                                                <button class="shrt-cart-btn" title="cart"><i
                                                        class="uil uil-shopping-cart-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <a href="course_detail_view.html" class="fcrse_img">
                                            <img src="/assets/images/courses/img-8.jpg" alt="">
                                            <div class="course-overlay">
                                                <div class="badge_seller">Bestseller</div>
                                                <div class="crse_reviews">
                                                    <i class='uil uil-star'></i>4.0
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <div class="crse_timer">
                                                    23 hours
                                                </div>
                                            </div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="eps_dots more_dropdown">
                                                <a href="#"><i class='uil uil-ellipsis-v'></i></a>
                                                <div class="dropdown-content">
                                                    <span><i class='uil uil-share-alt'></i>Share</span>
                                                    <span><i class="uil uil-heart"></i>Save</span>
                                                    <span><i class='uil uil-ban'></i>Not Interested</span>
                                                    <span><i class="uil uil-windsock"></i>Report</span>
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">196k views</span>
                                                <span class="vdt14">1 month ago</span>
                                            </div>
                                            <a href="course_detail_view.html" class="crse14s">CSS - The Complete
                                                Guide 2020 (incl. Flexbox, Grid & Sass)</a>
                                            <a href="#" class="crse-cate">Design | CSS</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot">By <a href="#">Jashanpreet Singh</a></p>
                                                <div class="prce142">$10</div>
                                                <button class="shrt-cart-btn" title="cart"><i
                                                        class="uil uil-shopping-cart-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section3126">
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="value_props">
                                    <div class="value_icon">
                                        <i class='uil uil-history'></i>
                                    </div>
                                    <div class="value_content">
                                        <h4>Go at your own pace</h4>
                                        <p>Enjoy lifetime access to courses on Edututs+'s website</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="value_props">
                                    <div class="value_icon">
                                        <i class='uil uil-user-check'></i>
                                    </div>
                                    <div class="value_content">
                                        <h4>Learn from industry experts</h4>
                                        <p>Select from top instructors around the world</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="value_props">
                                    <div class="value_icon">
                                        <i class='uil uil-play-circle'></i>
                                    </div>
                                    <div class="value_content">
                                        <h4>Find video courses on almost any topic</h4>
                                        <p>Build your library for your career and personal growth</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="value_props">
                                    <div class="value_icon">
                                        <i class='uil uil-presentation-play'></i>
                                    </div>
                                    <div class="value_content">
                                        <h4>100,000 online courses</h4>
                                        <p>Explore a variety of fresh topics</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

                @include('frontend.layouts.rightSidebar', [
                    'allDistrict' => $allDistrict,
                    'allMedium' => $allMedium,
                ])


                @include('frontend.components.state')

                <div class="col-xl-12 col-lg-12">
                    <div class="section3125 mt-30">

                            <div class="title589 text-center">
                              <h2>Guardians Experience</h2>
                              <img class="line-title" src="/assets/images/line.svg" alt="" />
                            </div>

                        <div class="la5lo1">
                            <div class="owl-carousel Student_says owl-theme">
                                <div class="item">
                                    <div class="fcrse_4 mb-20">
                                        <div class="say_content">
                                            <p>"Donec ac ex eu arcu euismod feugiat. In venenatis bibendum nisi, in
                                                placerat eros ultricies vitae. Praesent pellentesque blandit
                                                scelerisque. Suspendisse potenti."</p>
                                        </div>
                                        <div class="st_group">
                                            <div class="stud_img">
                                                <img src="/assets/images/left-imgs/img-4.jpg" alt="">
                                            </div>
                                            <h4>Jassica William</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_4 mb-20">
                                        <div class="say_content">
                                            <p>"Cras id enim lectus. Fusce at arcu tincidunt, iaculis libero quis,
                                                vulputate mauris. Morbi facilisis vitae ligula id aliquam. Nunc
                                                consectetur malesuada bibendum."</p>
                                        </div>
                                        <div class="st_group">
                                            <div class="stud_img">
                                                <img src="/assets/images/left-imgs/img-1.jpg" alt="">
                                            </div>
                                            <h4>Rock Smith</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_4 mb-20">
                                        <div class="say_content">
                                            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Class
                                                aptent taciti sociosqu ad litora torquent per conubia nostra, per
                                                inceptos himenaeos eros ac, sagittis orci."</p>
                                        </div>
                                        <div class="st_group">
                                            <div class="stud_img">
                                                <img src="/assets/images/left-imgs/img-7.jpg" alt="">
                                            </div>
                                            <h4>Luoci Marchant</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_4 mb-20">
                                        <div class="say_content">
                                            <p>"Nulla bibendum lectus pharetra, tempus eros ac, sagittis orci.
                                                Suspendisse posuere dolor neque, at finibus mauris lobortis in.
                                                Pellentesque vitae laoreet tortor."</p>
                                        </div>
                                        <div class="st_group">
                                            <div class="stud_img">
                                                <img src="/assets/images/left-imgs/img-6.jpg" alt="">
                                            </div>
                                            <h4>Poonam Sharma</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="fcrse_4 mb-20">
                                        <div class="say_content">
                                            <p>"Curabitur placerat justo ac mauris condimentum ultricies. In magna
                                                tellus, eleifend et volutpat id, sagittis vitae est. Pellentesque
                                                vitae laoreet tortor."</p>
                                        </div>
                                        <div class="st_group">
                                            <div class="stud_img">
                                                <img src="/assets/images/left-imgs/img-3.jpg" alt="">
                                            </div>
                                            <h4>Davinder Singh</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
