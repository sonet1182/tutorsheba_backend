<header class="header">
    <div class="page-brand">
        <a class="link" href="{{ url('/manager/dashboard') }}">
                    <span class="brand">Tutor
                        <span class="brand-tip">Sheba.com</span>
                    </span>
            <span class="brand-mini">TS</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>
            <li class="d-none d-sm-block">
                <h5>Manager Dashboard</h5>
            </li>
        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <a class="link" href="{{ url('/') }}" target="_blank">
                    <button type="button" class="btn btn-info"><i class="fa fa-home"></i></button>
                </a>
            </li>
            <li class="dropdown dropdown-inbox">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope-o"></i>
                    <span class="badge badge-primary envelope-badge">9</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                    <li class="dropdown-menu-header">
                        <div>
                            <span><strong>9 New</strong> Messages</span>
                            <a class="pull-right" href="{{ url('/admin') }}">view all</a>
                        </div>
                    </li>
                    <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                        <div>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <img src="{{ asset('admins/img/admin-avatar.png') }}" />
                                    </div>
                                    <div class="media-body">
                                        <div class="font-strong"> </div>Jeanne Gonzalez<small class="text-muted float-right">Just now</small>
                                        <div class="font-13">Your proposal interested me.</div>
                                    </div>
                                </div>
                            </a>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <img src="{{ asset('admins/img/admin-avatar.png') }}" />
                                    </div>
                                    <div class="media-body">
                                        <div class="font-strong"></div>Becky Brooks<small class="text-muted float-right">18 mins</small>
                                        <div class="font-13">Lorem Ipsum is simply.</div>
                                    </div>
                                </div>
                            </a>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <img src="{{ asset('admins/img/admin-avatar.png') }}" />
                                    </div>
                                    <div class="media-body">
                                        <div class="font-strong"></div>Frank Cruz<small class="text-muted float-right">18 mins</small>
                                        <div class="font-13">Lorem Ipsum is simply.</div>
                                    </div>
                                </div>
                            </a>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <img src="{{ asset('admins/img/admin-avatar.png') }}" />
                                    </div>
                                    <div class="media-body">
                                        <div class="font-strong"></div>Rose Pearson<small class="text-muted float-right">3 hrs</small>
                                        <div class="font-13">Lorem Ipsum is simply.</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="dropdown dropdown-notification">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o rel"><span class="notify-signal"></span></i></a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                    <li class="dropdown-menu-header">
                        <div>
                            <span><strong>5 New</strong> Notifications</span>
                            <a class="pull-right" href="javascript:;">view all</a>
                        </div>
                    </li>
                    <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                        <div>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <span class="badge badge-success badge-big"><i class="fa fa-check"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-13">4 task compiled</div><small class="text-muted">22 mins</small></div>
                                </div>
                            </a>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <span class="badge badge-default badge-big"><i class="fa fa-shopping-basket"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-13">You have 12 new orders</div><small class="text-muted">40 mins</small></div>
                                </div>
                            </a>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <span class="badge badge-danger badge-big"><i class="fa fa-bolt"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-13">Server #7 rebooted</div><small class="text-muted">2 hrs</small></div>
                                </div>
                            </a>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <span class="badge badge-success badge-big"><i class="fa fa-user"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-13">New user registered</div><small class="text-muted">2 hrs</small></div>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <img src="{{ asset('admins/img/admin-avatar.png') }}" />
                    <span></span>{{ Auth::guard('manager')->user()->name }}<i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>Profile</a>
                    {{-- <a class="dropdown-item" href="{{ url('manager/reset_password') }}"><i class="fa fa-cog"></i>Settings</a> --}}
                    <a class="dropdown-item" href="javascript:;"><i class="fa fa-support"></i>Support</a>
                    <li class="dropdown-divider"></li>
                    <a class="dropdown-item" href="{{ route('manager.logout')}}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    ><i class="fa fa-power-off"></i>Logout</a>
                    <form id="logout-form" action="{{ route('manager.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </ul>
            </li>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
