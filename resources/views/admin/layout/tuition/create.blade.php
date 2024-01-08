@extends('admin.master')

@section('title')
    Create New Tuition | Admin Desh Tutor
@stop

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Create New Tuition</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/new_student_request') }}">New Student Request</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/approval_student_list') }}">Approval Student List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/rejected_student_list') }}">Rejected student List</a></li>
        </ol>
    </div>


    @if (session('message'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{ session('message') }}.
        </div>
    @endif

    <div class="page-content my-5">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card my-5">
                    <div class="card-header">
                        <h4 class="text-center">REQUEST FOR A TUTOR</h4>
                    </div>
                    <div class="card-body parent-request-form">
                        <form method="post" action="{{ url('/admin/student/store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title*</label>
                                <input type="text" name="title" class="form-control form-control-lg" placeholder="Example: Need a tutor for Class X at Dhaka, Mirpur">
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="s_fullName">Name*</label>
                                    <input type="text" name="s_fullName" class="form-control{{ $errors->has('s_fullName') ? ' is-invalid' : '' }}" value="{{ old('s_fullName') }}" placeholder="Type your Name">
                                    @if ($errors->has('s_fullName'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('s_fullName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="s_college">Number of Student</label>
                                    <input type="number" name="student_number" class="form-control" value="1">
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="s_gender">Select Student Gender</label>
                                    <select name="s_gender" class="form-control">
                                        <option>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="s_college">Institute</label>
                                    <input type="text" name="s_college" class="form-control" placeholder="Type your Institute name">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="s_medium">Select Your Medium</label>
                                    <select name="s_medium" class="form-control medium" >
                                        <option disabled="disabled">Select your Medium</option>
                                        @foreach($medium as $allMedium)
                                            <option value="{{ $allMedium->mediumName }}">{{ $allMedium->mediumName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="s_class">Select Student Class</label>
                                    <div class="selectClass">
                                        <select name="s_class" class="form-control class single-select">
                                        </select>
                                    </div>
                                    <div class="loadingImgClass" style="display: none;">
                                        <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}" alt="TutorSheba" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="s_phoneNumber">Phone Number*</label>
                                    <input type="text" name="s_phoneNumber" class="form-control {{ $errors->has('s_phoneNumber') ? ' is-invalid' : '' }}" value="{{ old('s_phoneNumber') }}" placeholder="Type your phone number">
                                    @if ($errors->has('s_phoneNumber'))
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $errors->first('s_phoneNumber') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="s_email">E-Mail <small>(optional)</small></label>
                                    <input type="email" name="s_email" class="form-control" placeholder="Type your E-Mail">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="s_districts">Select City Name*</label>
                                    <select name="s_districts" class="form-control districts district {{ $errors->has('s_districts') ? ' is-invalid' : '' }}">
                                        <option value="null">Select City Name</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->districtName }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('s_districts'))
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('s_districts') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="s_area">Select Area Name*</label>
                                    <div class="selectArea">
                                        <select name="s_area" class="form-control area {{ $errors->has('s_area') ? ' is-invalid' : '' }}">
                                            <option value="null">Select Area</option>
                                        </select>
                                        @if ($errors->has('s_area'))
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $errors->first('s_area') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="loadingImgArea" style="display: none;">
                                        <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_address">Location Details*</label>
                                <textarea name="s_address" class="form-control" rows="2"></textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="t_gender">Select Teacher Gender</label>
                                    <select name="t_gender" class="form-control">
                                        <option>Select Gender</option>
                                        <option value="Any Gender">Any Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="t_days">Days Per Week</label>
                                    <select name="t_days" class="form-control days">
                                        <option value=" " >Please select your Day</option>
                                        <option value="1 Day/Week" >1 Day/Week</option>
                                        <option value="2 Days/Week" >2 Days/Week</option>
                                        <option value="3 Days/Week" >3 Days/Week</option>
                                        <option value="4 Days/Week" >4 Days/Week</option>
                                        <option value="5 Days/Week" >5 Days/Week</option>
                                        <option value="6 Days/Week" >6 Days/Week</option>
                                        <option value="7 Days/Week" >7 Days/Week</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="t_subject">Select Subject</label>
                                    <div class="selectSubject">
                                        <select name="t_subject[]" class="form-control subject tuition_sub sub_jec_maltiple" multiple="multiple">
                                        </select>
                                    </div>
                                    <div class="loadingImgSubject" style="display: none;">
                                        <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}" alt="TutorSheba" />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tutoring_type">Select Tutoring Type</label>
                                    <select class="form-control" name="tutoring_type">
                                        <option value="Home">Home</option>
                                        <option value="Online">Online</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="time">Tutoring Time</label>
                                        <select name="time" class="form-control single-select">
                                            <option value="" >Select Tutoring Time</option>
                                            <option value="05:00:00" > 05:00 am</option>
                                            <option value="06:00:00" > 06:00 am</option>
                                            <option value="07:00:00" > 07:00 am</option>
                                            <option value="08:00:00" > 08:00 am</option>
                                            <option value="09:00:00" > 09:00 am</option>
                                            <option value="10:00:00" > 10:00 am</option>
                                            <option value="11:00:00" > 11:00 am</option>
                                            <option value="12:00:00" > 12:00 pm</option>
                                            <option value="13:00:00" > 01:00 pm</option>
                                            <option value="14:00:00" > 02:00 pm</option>
                                            <option value="15:00:00" > 03:00 pm</option>
                                            <option value="16:00:00" > 04:00 pm</option>
                                            <option value="17:00:00" > 05:00 pm</option>
                                            <option value="18:00:00" > 06:00 pm</option>
                                            <option value="19:00:00" > 07:00 pm</option>
                                            <option value="20:00:00" > 08:00 pm</option>
                                            <option value="21:00:00" > 09:00 pm</option>
                                            <option value="22:00:00" > 10:00 pm</option>
                                            <option value="23:00:00" > 11:00 pm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="t_salary">Salary range</label>
                                        <select name="t_salary" class="form-control single-select">
                                            <option value="" >Please select Salary Range</option>
                                            @foreach ($salary as $sal)
                                                <option value="{{ $sal->salaryRange }}" >{{ $sal->salaryRange }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ex_info">Extra Information</label>
                                <textarea name="ex_info" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary">Submit Request <i class="fa fa-send"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
