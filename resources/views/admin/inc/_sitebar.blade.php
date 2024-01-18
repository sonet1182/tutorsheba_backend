@inject('request', 'Illuminate\Http\Request')

<nav class="page-sidebar st-1" id="sidebar">
    <div id="sidebar-collapse" class="st-2">
        <div class="st-3">
            <div class="admin-block d-flex">
                <div>
                    <img src="{{ asset('admins/img/admin-avatar.png') }}" width="45px" />
                </div>
                <div class="admin-info">
                    <div class="font-strong">{{ Auth::guard('admin')->user()->name }}</div><small>Administrator</small></div>
            </div>
            <ul class="side-menu metismenu">
                <li class="{{ Request::url() == url('/admin') ? 'active' : null }}">
                    <a href="{{ url('/admin') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>
                <li class="heading">TUTOR SECTION</li>
                <li class="{{ in_array($request->segment(2), ['new_teacher_request', 'approval_teacher_list', 'home_approval_teacher', 'rejected_teacher_list', 'verified_teacher_list']) ? 'active' : '' }}">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-graduation-cap"></i>
                        <span class="nav-label">Tutor Information</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li class="{{ $request->segment(2) == 'new_teacher_request' ? 'active-sub' : '' }}">
                            <a href="{{ url('/admin/new_teacher_request') }}"><i class="fa fa-hand-o-right"></i> New Request</a>
                        </li>
                        <li class="{{ $request->segment(2) == 'approval_teacher_list' ? 'active-sub' : '' }}">
                            <a href="{{ url('/admin/approval_teacher_list') }}"><i class="fa fa fa-hand-o-right"></i> Approval List</a>
                        </li>
                        <li class="{{ $request->segment(2) == 'verified_teacher_list' ? 'active-sub' : '' }}">
                            <a href="{{ url('/admin/verified_teacher_list') }}"><i class="fa fa fa-hand-o-right"></i> Verified List</a>
                        </li>
                        <li class="{{ $request->segment(2) == 'home_approval_teacher' ? 'active-sub' : '' }}">
                            <a href="{{ url('/admin/home_approval_teacher') }}"><i class="fa fa fa-hand-o-right"></i> Premium Tutors</a>
                        </li>
                        <li class="{{ $request->segment(2) == 'rejected_teacher_list' ? 'active-sub' : '' }}">
                            <a href="{{ url('/admin/rejected_teacher_list') }}"><i class="fa fa fa-hand-o-right"></i> Rejected List</a>
                        </li>
                    </ul>
                </li>

                <li class="heading">STUDENT SECTION</li>
                <li class="{{ in_array($request->segment(2), ['new_student_request', 'approval_student_list', 'rejected_student_list','pending_student_list','cancelled_student_list']) ? 'active' : '' }}">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-book"></i>
                        <span class="nav-label">Student Information</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li class="{{ $request->segment(2) == 'new_student_request' ? 'active-sub' : '' }}">
                            <a href="{{ url('/admin/new_student_request') }}"><i class="fa fa-hand-o-right"></i> New Request</a>
                        </li>
                        <li class="{{ $request->segment(2) == 'approval_student_list' ? 'active-sub' : '' }}">
                            <a href="{{ url('/admin/approval_student_list') }}"><i class="fa fa-hand-o-right"></i> Approval List</a>
                        </li>

                        <li class="{{ $request->segment(2) == 'pending_student_list' ? 'active-sub' : '' }}">
                            <a href="{{ url('/admin/pending_student_list') }}"><i class="fa fa-hand-o-right"></i> Pending List</a>
                        </li>

                        <li class="{{ $request->segment(2) == 'cancelled_student_list' ? 'active-sub' : '' }}">
                            <a href="{{ url('/admin/cancelled_student_list') }}"><i class="fa fa-hand-o-right"></i> Cancelled List</a>
                        </li>


                        <li class="{{ $request->segment(2) == 'rejected_student_list' ? 'active-sub' : '' }}">
                            <a href="{{ url('/admin/rejected_student_list') }}"><i class="fa fa-hand-o-right"></i> Rejected List</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ $request->segment(2) == 'student' ? 'active' : '' }}">
                    <a href="{{ url('/admin/student/create') }}"><i class="sidebar-item-icon fa fa-ticket"></i>
                        <span class="nav-label">Submit new tuition</span>
                    </a>
                </li>


                <li class="heading">REQUEST </li>
                <li class="{{ $request->segment(2) == 'student_tutor_request' ? 'active' : '' }}">
                    <a href="{{ url('admin/student_tutor_request') }}"><i class="sidebar-item-icon fa fa-subway"></i>
                        <span class="nav-label">Student Request</span>
                    </a>
                </li>
                <li class="{{ $request->segment(2) == 'teacher_tuition_request' ? 'active' : '' }}">
                    <a href="{{ url('admin/teacher_tuition_request') }}"><i class="sidebar-item-icon fa fa-smile-o"></i>
                        <span class="nav-label">Teacher Request</span>
                    </a>
                </li>

                <li class="heading">Payment </li>
                <li class="{{ $request->segment(2) == 'payment_sheet' ? 'active' : '' }}">
                    <a href="{{ url('admin/payment_sheet') }}"><i class="sidebar-item-icon fa fa-money"></i>
                        <span class="nav-label">Payment Sheet</span>
                    </a>
                </li>
                <li class="{{ $request->segment(2) == 'transactions' ? 'active' : '' }}">
                    <a href="{{ url('admin/transactions') }}"><i class="sidebar-item-icon fa fa-dollar"></i>
                        <span class="nav-label">Transactions</span>
                    </a>
                </li>


                <li class="heading">VERIFICATION REQUEST </li>
                <li class="{{ $request->segment(2) == 'profile_verification_request' ? 'active' : '' }}">
                    <a href="{{ url('admin/profile_verification_request') }}"><i class="sidebar-item-icon fa fa-smile-o"></i>
                        <span class="nav-label">Profile Verification Request</span>
                    </a>
                </li>
                <li class="{{ $request->segment(2) == 'premium_profile_request' ? 'active' : '' }}">
                    <a href=""><i class="sidebar-item-icon fa fa-smile-o"></i>
                        <span class="nav-label">Premium Profile Request</span>
                    </a>
                </li>


                <li class="{{ $request->segment(2) == 'all_user' ? 'active' : '' }}">
                    <a href="{{ url('/admin/all_user') }}"><i class="sidebar-item-icon fa fa-users"></i>
                        <span class="nav-label">All Users</span>
                    </a>
                </li>
                <li class="{{ $request->segment(2) == 'contact' ? 'active' : '' }}">
                    <a href="{{ url('/admin/contact') }}"><i class="sidebar-item-icon fa fa-calendar"></i>
                        <span class="nav-label">Contact Message</span>
                    </a>
                </li>

                <li class="heading">NOTICE SECTION</li>
                <li class="{{ in_array($request->segment(2), ['notice/broadcast', 'notice/individual']) ? 'active' : '' }}">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-list"></i>
                        <span class="nav-label">Notice manage</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li class="{{ $request->segment(2) == 'broadcast' ? 'active-sub' : '' }}"><a href="{{ url('admin/notice/broadcast') }}"><i class="fa fa-hand-o-right"></i> Broadcast Notice </a></li>
                        <li class="{{ $request->segment(2) == 'individual' ? 'active-sub' : '' }}"><a href="{{ url('admin/notice/individual') }}"><i class="fa fa-hand-o-right"></i> Individual Notice </a></li>

                    </ul>
                </li>

                <li class="heading">MESSAGE SECTION</li>
                <li class="{{ Request::url() == url('/admin/all_text') ? 'active' : null }}">
                    <a href="{{ url('admin/all_text') }}"><i class="sidebar-item-icon fa fa-envelope" aria-hidden="true"></i>
                        <span class="nav-label">All Text</span>
                    </a>
                </li>


                <li class="heading">TUTOR STUDY FIELD SECTION</li>
                <li class="{{ in_array($request->segment(2), ['institution_type']) ? 'active' : '' }}">
                    <a href="{{ url('admin/institution_type') }}"><i class="sidebar-item-icon fa fa-institution"></i>
                        <span class="nav-label">Institute Type</span>
                    </a>
                </li>

                <li class="{{ in_array($request->segment(2), ['university']) ? 'active' : '' }}">
                    <a href="{{ url('admin/university') }}"><i class="sidebar-item-icon fa fa-institution"></i>
                        <span class="nav-label">University</span>
                    </a>
                </li>

                <li class="{{ in_array($request->segment(2), ['study_type']) ? 'active' : '' }}">
                    <a href="{{ url('admin/study_type') }}"><i class="sidebar-item-icon fa fa-book"></i>
                        <span class="nav-label">Study Type</span>
                    </a>
                </li>

                <li class="{{ in_array($request->segment(2), ['department']) ? 'active' : '' }}">
                    <a href="{{ url('admin/department') }}"><i class="sidebar-item-icon fa fa-book"></i>
                        <span class="nav-label">Department</span>
                    </a>
                </li>




                <li class="heading">MANAGER MANAGEMENT</li>
                <li class="{{ Request::url() == url('/admin/all_manager') ? 'active' : null }}">
                    <a href="{{ url('admin/all_manager') }}"><i class="sidebar-item-icon fa fa-envelope" aria-hidden="true"></i>
                        <span class="nav-label">Add Tuition Manager</span>
                    </a>
                </li>
                <li class="{{ Request::url() == url('/admin/logout_managing') ? 'active' : null }}">
                    <a href="{{ url('admin/logout_managing') }}"><i class="sidebar-item-icon fa fa-envelope" aria-hidden="true"></i>
                        <span class="nav-label">Logout Managing</span>
                    </a>
                </li>


                <li class="heading">UDDOKTA MANAGEMENT</li>
                <li class="{{ Request::url() == url('/admin/uddokta_list') ? 'active' : null }}">
                    <a href="{{ url('admin/uddokta_list') }}"><i class="sidebar-item-icon fa fa-envelope" aria-hidden="true"></i>
                        <span class="nav-label">Uddokta List</span>
                    </a>
                </li>



                <li class="heading">Search MANAGEMENT</li>

                <li class="{{ in_array($request->segment(2), ['all-districts', 'all-area', 'all-medium', 'any-class', 'any-subject', 'salary-range']) ? 'active' : '' }}">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-search"></i>
                        <span class="nav-label">Search manage</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li class="{{ $request->segment(2) == 'all-districts' ? 'active-sub' : '' }}"><a href="{{ url('admin/all-districts') }}"><i class="fa fa-hand-o-right"></i> DISTRICTS LIST</a></li>
                        <li class="{{ $request->segment(2) == 'all-area' ? 'active-sub' : '' }}"><a href="{{ url('admin/all-area') }}"><i class="fa fa-hand-o-right"></i> AREA LIST</a></li>
                        <li class="{{ $request->segment(2) == 'all-medium' ? 'active-sub' : '' }}"><a href="{{ url('admin/all-medium') }}"><i class="fa fa-hand-o-right"></i> MEDIUM LIST</a></li>
                        <li class="{{ $request->segment(2) == 'any-class' ? 'active-sub' : '' }}"><a href="{{ url('admin/any-class') }}"><i class="fa fa-hand-o-right"></i> CLASS LIST</a></li>
                        <li class="{{ $request->segment(2) == 'any-subject' ? 'active-sub' : '' }}"><a href="{{ url('admin/any-subject') }}"><i class="fa fa-hand-o-right"></i> SUBJECT LIST</a></li>
                        <li class="{{ $request->segment(2) == 'salary-range' ? 'active-sub' : '' }}"><a href="{{ url('admin/salary-range') }}"><i class="fa fa-hand-o-right"></i> SALARY RANGE</a></li>
                    </ul>
                </li>

                <li class="heading">DATA EXPORT</li>
                 <li class="{{ in_array($request->segment(2), ['tutor-list', 'premium_teacher']) ? 'active' : '' }}">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-user"></i>
                        <span class="nav-label">Tutor Information</span><i class="fa fa-angle-left arrow"></i></a>
                     <ul class="nav-2-level collapse">
                       <li class="{{ $request->segment(2) == 'tutor-list' ? 'active-sub' : '' }}">
                            <a href="{{ url('/admin/tutor-list') }}"><i class="fa fa-hand-o-right"></i> Teacher List</a>
                        </li>
                    </ul>
                </li>



                <li class="{{ in_array($request->segment(2), ['membership']) ? 'active' : '' }}">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-meetup"></i>
                        <span class="nav-label">Membership</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li class="{{ $request->segment(2) == 'membership' ? 'active-sub' : '' }}"><a href="{{ url('/admin/membership') }}"><i class="fa fa-hand-o-right"></i> Member list</a></li>
                    </ul>
                </li>
                <li class="{{ in_array($request->segment(2), ['alladdbalance']) ? 'active' : '' }}">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-money"></i>
                        <span class="nav-label">My Balance</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li class="{{ $request->segment(2) == 'alladdbalance' ? 'active-sub' : '' }}"><a href="{{ url('/admin/alladdbalance') }}"><i class="fa fa-hand-o-right"></i> All Add Balance List</a></li>
                    </ul>
                </li>
                <li class="{{ in_array($request->segment(2), ['slider']) ? 'active' : '' }}">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-google"></i>
                        <span class="nav-label">Slider Manage</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li class="{{ $request->segment(2) == 'slider' && Request::url() == url('/admin/slider') ? 'active-sub' : '' }}"><a href="{{ url('/admin/slider') }}"><i class="fa fa-hand-o-right"></i> Slider</a></li>
                        <li class="{{ $request->segment(2) == 'slider' && Request::url() == url('/admin/slider/add') ? 'active-sub' : '' }}"><a href="{{ url('/admin/slider/add') }}"><i class="fa fa-hand-o-right"></i> Add New Slider</a></li>
                    </ul>
                </li>
                <li class="{{ in_array($request->segment(2), ['ads-images']) ? 'active' : '' }}">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-buysellads"></i>
                        <span class="nav-label">Ads Manage</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li class="{{ $request->segment(2) == 'ads-images' && Request::url() == url('/admin/ads-images') ? 'active-sub' : '' }}"><a href="{{ url('/admin/ads-images') }}"><i class="fa fa-hand-o-right"></i> Ads</a></li>
                        <li class="{{ $request->segment(2) == 'ads-images' && Request::url() == url('/admin/ads-images/add') ? 'active-sub' : '' }}"><a href="{{ url('/admin/ads-images/add') }}"><i class="fa fa-hand-o-right"></i> Add New Ads</a></li>
                    </ul>
                </li>
                <li class="{{ in_array($request->segment(2), ['faq-data']) ? 'active' : '' }}">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-bolt"></i>
                        <span class="nav-label">FAQ Data</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li class="{{ $request->segment(2) == 'faq-data' && Request::url() == url('/admin/faq-data') ? 'active-sub' : '' }}"><a href="{{ url('/admin/faq-data') }}"><i class="fa fa-hand-o-right"></i> FAQ List</a></li>
                        <li class="{{ $request->segment(2) == 'faq-data' && Request::url() == url('/admin/faq-data/create') ? 'active-sub' : '' }}"><a href="{{ url('/admin/faq-data/create') }}"><i class="fa fa-hand-o-right"></i> Add New</a></li>
                    </ul>
                </li>
                <li class="{{ in_array($request->segment(2), ['howitworks-data']) ? 'active' : '' }}">
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-info-circle"></i>
                        <span class="nav-label">How It Works Data</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li class="{{ $request->segment(2) == 'howitworks-data' && Request::url() == url('/admin/howitworks-data') ? 'active-sub' : '' }}"><a href="{{ url('/admin/howitworks-data') }}"><i class="fa fa-hand-o-right"></i> How It Works List</a></li>
                        <li class="{{ $request->segment(2) == 'howitworks-data' && Request::url() == url('/admin/howitworks-data/create') ? 'active-sub' : '' }}"><a href="{{ url('/admin/howitworks-data/create') }}"><i class="fa fa-hand-o-right"></i> Add New</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
