@extends('frontend.layouts.master')

@section('content')
    <div class="sa4d25">
        <div class="parent">
            <div class="container">
                @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('message') }}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center">REQUEST FOR A TUTOR</h4>
                            </div>
                            <div class="card-body parent-request-form">
                                <form method="post" action="{{ url('/tuition_request') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Title*</label>
                                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Example: Need a tutor for Class X at Dhaka, Mirpur">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Name*</label>
                                        <input type="text" name="s_fullName" class="form-control{{ $errors->has('s_fullName') ? ' is-invalid' : '' }}" value="{{ old('s_fullName') }}" placeholder="Type your Name">
                                        @if ($errors->has('s_fullName'))
                                            <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $errors->first('s_fullName') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="exampleFormControlInput1">Select Student Gender</label>
                                            <select name="s_gender" class="form-control">
                                                <option>Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Institute</label>
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
                                                <select name="s_class" class="form-control  class single-select">
                                                </select>
                                            </div>
                                            <div class="loadingImgClass" style="display: none;">
                                                <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}" alt="TutorSheba" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Phone Number*</label>
                                            <input type="text" name="s_phoneNumber" class="form-control {{ $errors->has('s_phoneNumber') ? ' is-invalid' : '' }}" value="{{ old('s_phoneNumber') }}" placeholder="Type your phone number">
                                            @if ($errors->has('s_phoneNumber'))
                                                <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $errors->first('s_phoneNumber') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">E-Mail <small>(optional)</small></label>
                                            <input type="email" name="s_email" class="form-control" placeholder="Type your E-Mail">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="s_districts">Select City Name*</label>
                                            <select name="s_districts" class="form-control districts single-select {{ $errors->has('s_districts') ? ' is-invalid' : '' }}">
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
                                                <select name="s_area" class="form-control area single-select {{ $errors->has('s_area') ? ' is-invalid' : '' }}">
                                                    <option value="null">Select Area</option>
                                                </select>
                                                @if ($errors->has('s_area'))
                                                    <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $errors->first('s_area') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="loadingImgArea" style="display: none;">
                                                <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}" alt="TutorSheba" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="s_address">Location Details*</label>
                                        <textarea name="s_address" class="form-control" rows="2"></textarea>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Select Teacher Gender</label>
                                            <select name="t_gender" class="form-control">
                                            <option>Select Gender</option>
                                            <option value="Any Gender">Any Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Days Per Week</label>
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
                                    </div>
                                    <div class="form-group">
                                        <label for="t_subject">Select Subject</label>
                                        <div class="selectSubject">
                                            <select name="t_subject[]" class="form-control subject single-select" multiple="multiple">
                                            </select>
                                        </div>
                                        <div class="loadingImgSubject" style="display: none;">
                                            <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}" alt="TutorSheba" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="t_salary">Salary range</label>
                                        <select name="t_salary" class="form-control single-select">
                                            <option value="" >Please select Salary Range</option>
                                            @foreach($salary as $allSalary)
                                                <option value="{{ $allSalary->salaryRange }}" >{{ $allSalary->salaryRange }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ex_information">Extra Information</label>
                                        <textarea name="ex_information" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-default">Submit Request <i class="fa fa-send"></i></button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <h3 class="bg-custom text-light py-3 pl-3">HELP & INFO</h3>
                            <div class="p-2">
                            <strong>Q. If i cant get the desired tutor ?</strong>
                            <p class="mt-1 text-secondary">
                                Just fill up the request tutor form and send us. We will try to find your desired tutor.
                            </p>
                            <strong>Q. what will happen after fill the forms ?</strong>
                            <p class="mt-1 text-secondary text-justify">
                                After fill up the form the information will be sent to tutorsheba support team. They will review/ verify the info and will publish on the available tuitions section.
                            </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('meta_description')
<meta name="description" content="Tutor Sheba is a very easy way find home tutors and tuitions, We can help students and tutors find each other, If you need a tutor please submit a request.">
@endsection

