@extends('admin.master')

@section('title', 'Search Result | admin')

@section('content')
    <style>
        .teacher_list {
            margin-bottom: 8px;
            padding: 10px;
            border: 1px double #0C83AF;
        }

        .teacher_list:hover {
            background-color: #f2dede;
        }

        .exper {
            margin-left: 10px;
        }

        .styleBorderImg {
            width: 120px;
            height: 130px;
        }
    </style>

    <div class="page-heading">
        <h1 class="page-title">Search Result</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="icon-home2 position-left"></i>
                    Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/new_teacher_request') }}">New Teacher</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/home_approval_teacher') }}">Home Approval Teacher</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/approval_teacher_list') }}">Approval Teacher</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/rejected_teacher_list') }}">Rejected Teacher</a></li>
        </ol>
    </div>

    <form action="{{ url('admin/send_bulk_text') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="ibox">
                    <div class="ibox-body table-responsive row">
                        <h4><input type="checkbox" name="select_option" style="height: 20px; width: 20px" id="select_option"
                                onclick="checkedAll.call(this);">&nbsp;Select/Unsellect All</h4>
                        <button type="button" class="btn btn-lg btn-primary" data-toggle="modal"
                            data-target="#exampleModal">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            Send Message
                        </button>
                    </div>
                </div>
            </div>
        </div>


        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('message') }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5 for="exampleInputEmail1">Enter Message Here...</h5>
                            <hr>
                            <textarea placeholder="" class="form-control" name="message" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-lg btn-outline-primary px-4">Submit</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="page-content fade-in-up my-5">
            <div class="row">
                <div class="col-md-12">
                    @foreach ($teacherProfile as $profile)
                        @if ($profile->user)
                            <div class="card teacher_list">
                                <div class="row">
                                    <div class="col-sm-1 space-htop">
                                        <h3 class="text-center py-auto may-auto">
                                            <input class="text-center" type="checkbox" name="all_option[]"
                                                value="{{ $profile->user ? $profile->user->phoneNumber : '' }}"
                                                style="font-size: 40px">
                                        </h3>

                                    </div>
                                    <div class="col-md-2 col-sm-5 col-xs-12 text-center">
                                        <a href="{{ url('/tutor_details') }}/{{ $profile->teacher_id }}">

                                            <!--<img src="{{ empty($profile->teacher_profile_picture) ? asset('images/allUsers.jpg') : asset($profile->teacher_profile_picture) }}" alt="{{ $profile->teacher_name }}" class="styleBorderImg" style="height:120px; width:120px"/> -->

                                            <img src="{{ asset($profile->teacher_profile_picture) }}" alt="Image not found"
                                                onerror="this.src='https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg';"
                                                class="styleBorderImg" style="height:120px; width:120px" />


                                        </a>


                                        <br>
                                        <strong>ID # {{ $profile->teacher_id }} </strong>
                                    </div>
                                    <div class="col-md-4 col-sm-7 col-xs-12"> <strong><span class="text-info">
                                                {{ $profile->user ? $profile->user->name : '' }}</span>

                                            <div class="mt-2">
                                                @if ($profile->user && $profile->user->approval == 1)
                                                    <span class="badge badge-pill badge-success px-4">Approved</span>
                                                @elseif($profile->user && $profile->user->approval == 3)
                                                    <span class="badge badge-pill badge-danger px-4">Rejected</span>
                                                @else
                                                    <span class="badge badge-pill badge-warning px-4">Pending</span>
                                                @endif

                                                @if ($profile->user && $profile->user->verified == 1)
                                                    <span class="badge badge-pill badge-primary px-4"><i
                                                            class="fa fa-star font-14"></i> Verified</span>
                                                @endif


                                                @if ($profile->home_approval == 1)
                                                    <span class="badge badge-pill badge-danger px-4"><i
                                                            class="fa fa-heart font-14"></i> Premium</span>
                                                @endif
                                            </div>

                                        </strong> <br>
                                        <span style="color: green;"> Member Since: {{ substr($profile->created_at, 0, 10) }}
                                        </span> <br>
                                        <span>{{ $profile->tuition_salary }}</span> <br>
                                        <strong>Qualification:</strong> {{ $profile->teacher_degree }} <br>
                                        <strong>Honours Ins:</strong> {{ $profile->honours_institute }} <br>
                                        <strong>Tuition Me:</strong> {{ $profile->tuition_medium }} <br>
                                        <strong>Teaching:</strong> {{ $profile->tuition_subject }}
                                    </div>
                                    <div class="col-sm-3 space-htop">
                                        <strong>{{ $profile->districts ? $profile->districts->districtName : '' }}
                                            <br></strong> <span class="text-lowercase">{{ $profile->tuition_area }}</span>

                                    </div>
                                    <div class="col-sm-2">
                                        <a href="{{ url('/admin/teacher_details') }}{{ $profile->user ? $profile->user->id : '' }}"
                                            class="btn btn-lg btn-info">View Details</a>
                                        {{-- <a href="{{ url('/teacher_details') }}{{ $profile->id }}"> <button type="button" class=""> <strong>  Contact  </strong> </button> </a> --}}
                                    </div>
                                </div>
                                <div class="row exper">
                                    <div class="col-md-2 col-sm-5 col-xs-12">
                                    </div>
                                    <div class="col-md-10 col-sm-7 col-xs-12"><strong>Experience:</strong>
                                        {{ $profile->tuition_experience }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="pull-right mt-3 mr-5">
                        {{ $teacherProfile->appends(Request::except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>

    </form>

    <script>
        function checkedAll() {

            var elements = document.querySelectorAll('input[type="checkbox"]');
            for (var i = elements.length; i--;) {
                if (elements[i].type == 'checkbox') {
                    elements[i].checked = this.checked;
                }
            }
        }
    </script>
@endsection
