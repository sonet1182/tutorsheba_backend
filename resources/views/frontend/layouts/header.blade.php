<header class="header clearfix" style="background: #6c2a8c;">
    <button type="button" id="toggleMenu" class="toggle_menu">
        <i class='uil uil-bars' style="background: transparent;
        color: #fff;"></i>
    </button>
    <button id="collapse_menu" class="collapse_menu">
        <i class="uil uil-bars collapse_menu--icon "></i>
        <span class="collapse_menu--label"></span>
    </button>
    <div class="main_logo" id="logo">
        <a href="{{ url('/') }}"><img src="/assets/images/logo.png" alt="" style="width: 130px"></a>
        {{-- <a href="{{ url('/') }}"><img class="logo-inverse" src="/assets/images/ct_logo.svg" alt=""></a> --}}
    </div>
    {{-- <div class="top-category">
        <div class="ui compact menu cate-dpdwn">
            <div class="ui simple dropdown item">
                <a href="#" class="option_links p-0" title="categories"><i class="uil uil-apps"></i></a>
                <div class="menu dropdown_category5">
                    <a href="#" class="item channel_item">Development</a>
                    <a href="#" class="item channel_item">Business</a>
                    <a href="#" class="item channel_item">Finance & Accounting</a>
                    <a href="#" class="item channel_item">IT & Software</a>
                    <a href="#" class="item channel_item">Office Productivity</a>
                    <a href="#" class="item channel_item">Personal Development</a>
                    <a href="#" class="item channel_item">Design</a>
                    <a href="#" class="item channel_item">Marketing</a>
                    <a href="#" class="item channel_item">Lifestyle</a>
                    <a href="#" class="item channel_item">Photography</a>
                    <a href="#" class="item channel_item">Health & Fitness</a>
                    <a href="#" class="item channel_item">Music</a>
                    <a href="#" class="item channel_item">Teaching & Academics</a>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="search120">
        <div class="ui search">
            <div class="ui left icon input swdh10">
                <input class="prompt srch10" type="text"
                    placeholder="Search for Tuts Videos, Tutors, Tests and more..">
                <i class='uil uil-search-alt icon icon1'></i>
            </div>
        </div>
    </div>
    <div class="header_right">
        <ul>
            <li>
                <a href="{{ route('tutor_request') }}" class="upload_btn" title="Create Tutor Request">Create Tutor Request</a>
            </li>
            <li>
                <a href="shopping_cart.html" class="option_links" title="cart"><i
                        class='uil uil-shopping-cart-alt'></i><span class="noti_count">2</span></a>
            </li>
            <li class="ui dropdown">
                <a href="#" class="option_links" title="Messages"><i
                        class='uil uil-envelope-alt'></i><span class="noti_count">3</span></a>
                <div class="menu dropdown_ms">
                    <a href="#" class="channel_my item">
                        <div class="profile_link">
                            <img src="/assets/images/left-imgs/img-6.jpg" alt="">
                            <div class="pd_content">
                                <h6>Zoena Singh</h6>
                                <p>Hi! Sir, How are you. I ask you one thing please explain it this video price.</p>
                                <span class="nm_time">2 min ago</span>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="channel_my item">
                        <div class="profile_link">
                            <img src="/assets/images/left-imgs/img-5.jpg" alt="">
                            <div class="pd_content">
                                <h6>Joy Dua</h6>
                                <p>Hello, I paid you video tutorial but did not play error 404.</p>
                                <span class="nm_time">10 min ago</span>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="channel_my item">
                        <div class="profile_link">
                            <img src="/assets/images/left-imgs/img-8.jpg" alt="">
                            <div class="pd_content">
                                <h6>Jass</h6>
                                <p>Thanks Sir, Such a nice video.</p>
                                <span class="nm_time">25 min ago</span>
                            </div>
                        </div>
                    </a>
                    <a class="vbm_btn" href="instructor_messages.html">View All <i
                            class='uil uil-arrow-right'></i></a>
                </div>
            </li>
            <li class="ui dropdown">
                <a href="#" class="option_links" title="Notifications"><i class='uil uil-bell'></i><span
                        class="noti_count">3</span></a>
                <div class="menu dropdown_mn">
                    <a href="#" class="channel_my item">
                        <div class="profile_link">
                            <img src="/assets/images/left-imgs/img-1.jpg" alt="">
                            <div class="pd_content">
                                <h6>Rock William</h6>
                                <p>Like Your Comment On Video <strong>How to create sidebar menu</strong>.</p>
                                <span class="nm_time">2 min ago</span>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="channel_my item">
                        <div class="profile_link">
                            <img src="/assets/images/left-imgs/img-2.jpg" alt="">
                            <div class="pd_content">
                                <h6>Jassica Smith</h6>
                                <p>Added New Review In Video <strong>Full Stack PHP Developer</strong>.</p>
                                <span class="nm_time">12 min ago</span>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="channel_my item">
                        <div class="profile_link">
                            <img src="/assets/images/left-imgs/img-9.jpg" alt="">
                            <div class="pd_content">
                                <p> Your Membership Approved <strong>Upload Video</strong>.</p>
                                <span class="nm_time">20 min ago</span>
                            </div>
                        </div>
                    </a>
                    <a class="vbm_btn" href="instructor_notifications.html">View All <i
                            class='uil uil-arrow-right'></i></a>
                </div>
            </li>
            <li class="ui dropdown">
                <a href="#" class="opts_account" title="Account">
                    @if(Auth::user())
                    <img src="{{ asset(Auth::user()->teacher->teacher_profile_picture) }}" alt="" onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/data/icons/instagram-ui-twotone/48/Paul-18-512.png';">
                    @else
                    <img src="/assets/images/left-imgs/img-1.jpg" alt="">
                    @endif
                </a>
                <div class="menu dropdown_account">

                    @if(Auth::user())

                    <div class="channel_my">
                        <div class="profile_link">
                            @if(Auth::user())
                    <img src="{{ asset(Auth::user()->teacher->teacher_profile_picture) }}" alt="" onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/data/icons/instagram-ui-twotone/48/Paul-18-512.png';">
                    @else
                    <img src="/assets/images/left-imgs/img-1.jpg" alt="">
                    @endif
                            <div class="pd_content">
                                <div class="rhte85">
                                    <h6>{{ Auth::user()->name }}</h6>
                                    <div class="mef78" title="Verify">
                                        <i class='uil uil-check-circle'></i>
                                    </div>
                                </div>
                                <span>
                                    {{-- {{ Auth::user()->email }} --}}
                                    <a href="https://gambolthemes.net/cdn-cgi/l/email-protection"
                                        class="__cf_email__"
                                        >
                                    {{ Auth::user()->email }}
                                    </a></span>
                            </div>
                        </div>
                        <a href="my_instructor_profile_view.html" class="dp_link_12">View Profile</a>
                    </div>


                    <a href="setting.html" class="item channel_item">Setting</a>
                    <a href="help.html" class="item channel_item">Help</a>
                    <a href="feedback.html" class="item channel_item">Send Feedback</a>


                    <form method="POST" action="{{ route('logout') }}" class="item channel_item">
                        @csrf

                        <a class="" :href="route('logout')" style="color: rgb(223, 55, 55)"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
                             Sign Out
                        </a>
                    </form>


                    @else

                    <a href="{{ route('login') }}" class="item channel_item">Login</a>
                    <a href="{{ route('register') }}" class="item channel_item">Register</a>

                    @endif



                    <div class="night_mode_switch__btn" style="min-width: 200px">
                        <a href="#" id="night-mode" class="btn-night-mode">
                            <i class="uil uil-moon"></i> Night mode
                            <span class="btn-night-mode-switch">
                                <span class="uk-switch-button"></span>
                            </span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
