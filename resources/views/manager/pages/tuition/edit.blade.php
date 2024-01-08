@extends('manager.layouts.master')

@section('title')
    ID#  Tuition Details | Manager
@stop

@section('content')
    <div class="page-heading">
        <h1 class="page-title">ID# 01000 <strong>Student Information</strong></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/manager/new_student_request') }}">New Student Request</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/manager/approval_student_list') }}">Approval Student List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/manager/rejected_student_list') }}">Rejected student List</a></li>
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
                        <form method="post" action="{{ url('/manager/tuition/update') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Title*</label>
                                <input type="text" name="title" class="form-control form-control-lg" value="{{ $tuition->title }}" placeholder="Example: Need a tutor for Class X at Dhaka, Mirpur">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Name*</label>
                                <input type="text" name="s_fullName" class="form-control{{ $errors->has('s_fullName') ? ' is-invalid' : '' }}" value="{{ $tuition->s_fullName }}" >
                                <input type="hidden" name="id" value="{{ $tuition->id }}" >
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
                                        <option value="{{ empty($tuition->s_gender)?'':$tuition->s_gender }}">{{ empty($tuition->s_gender)?'Select Gender':$tuition->s_gender }}</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Institute</label>
                                    <input type="text" name="s_college" class="form-control" value="{{ $tuition->s_college }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Select Your Medium</label>
                                    <select name="s_medium" class="form-control medium" >
                                        <option value="{{ empty($tuition->s_medium)?'':$tuition->s_medium }}">{{ empty($tuition->s_medium)?'Select your Medium':$tuition->s_medium }}</option>
                                        @foreach($medium as $allMedium)
                                            <option value="{{ $allMedium->mediumName }}">{{ $allMedium->mediumName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="s_class">Select Student Class </label>
                                    <div class="selectClass">
                                        <select name="s_class" class="form-control class single-select">
                                           @foreach($classes as $class_data)
                                            <option value="{{ $class_data->className }}" {{ $class_data->className == $tuition->s_class ? 'selected' : '' }}>{{ $class_data->className }}</option>
                                            @endforeach
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
                                    <input type="text" name="s_phoneNumber" class="form-control {{ $errors->has('s_phoneNumber') ? ' is-invalid' : '' }}" value="{{ $tuition->s_phoneNumber }}" placeholder="Type your phone number">
                                    @if ($errors->has('s_phoneNumber'))
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $errors->first('s_phoneNumber') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">E-Mail <small>(optional)</small></label>
                                    <input type="email" name="s_email" class="form-control" value="{{ $tuition->s_email }}" placeholder="Type your E-Mail">
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="selectCityName">Select City Name*</label>
                                    <select name="s_districts" class="form-control districts district {{ $errors->has('s_districts') ? ' is-invalid' : '' }}">
                                        <!--<option value="{{ empty($tuition->s_districts)?'':$tuition->s_districts }}">{{ empty($tuition->s_districts)?'Select City Name':$tuition->districts->districtName }}</option>-->
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}" {{ $district->id == $tuition->s_districts ? 'selected' : '' }}>{{ $district->districtName }}</option>
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
                                            @foreach($areas as $area)
                                                <option value="{{ $area->areaName }}" {{ $area->areaName == $tuition->s_area ? 'selected' : '' }}>{{ $area->areaName }}</option>
                                            @endforeach
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
                                <label for="locationDetails">Location Details*</label>
                                <textarea name="s_address" class="form-control" rows="2">{{ $tuition->s_address }}</textarea>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Select Teacher Gender</label>
                                    <select name="t_gender" class="form-control">
                                        <option value="{{ empty($tuition->t_gender)?'':$tuition->t_gender }}">{{ empty($tuition->t_gender)?'Select teacher Gender':$tuition->t_gender }}</option>
                                        <option value="Any Gender">Any Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Days Per Week</label>
                                    <select name="t_days" class="form-control days">
                                        <option value="{{ empty($tuition->t_days)?'':$tuition->t_days }}" >{{ empty($tuition->t_days)?'Please select your Day':$tuition->t_days }}</option>
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
                                <!--<label for="exampleFormControlInput1">Select Subject</label>-->
                                <!--<select name="t_subject[]" class="form-control tuition_sub">-->

                                <!--    <option value="{{ empty($tuition->t_subject)?'':$tuition->t_subject }}">{{ empty($tuition->t_subject)?'':$tuition->t_subject }}</option>-->
                                <!--    @foreach($subject as $allSubject)-->
                                <!--        <option value="{{ $allSubject->subjectName }}" class="text-uppercase">{{ $allSubject->subjectName }}</option>-->
                                <!--    @endforeach-->
                                <!--</select>-->

                                <label for="t_subject">Select Subject</label>
                                <div class="selectSubject">
                                    <select name="t_subject[]" id="student_subject" class="form-control subject single-select" multiple="multiple">                                            <option value="" >Select One</option>
                                    </select>
                                </div>
                                <div class="loadingImgSubject" style="display: none;">
                                    <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}" alt="TutorSheba" />
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Salary range</label>
                                        <select name="t_salary" class="form-control single-select">
                                            <option value="" >Please select Salary Range</option>
                                            @foreach ($salary as $sal)
                                                <option value="{{ $sal->salaryRange }}" {{ $tuition->t_salary == $sal->salaryRange ? 'selected' : '' }}>{{ $sal->salaryRange }} Tk/Month</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Select Manager</label>
                                        <select name="manager" class="form-control single-select">
                                            @foreach($managers as $manager)
                                            <option value="{{ $manager->id }}" {{ $tuition->manager == $manager->id ? 'selected' : '' }}>{{ $manager->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Extra Information</label>
                                <textarea name="ex_info" class="form-control" rows="3">{{ $tuition->ex_information }}</textarea>
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

@section('script')

    <script>
$(document).ready(function(){
    var s2 = $("#student_subject").select2({
    placeholder: "Choose event type",
    tags: true
    });

     //var vals = ['math', 'Maths', 'Science'];

    var vals = <?php echo json_encode(explode (", ", $tuition->t_subject)); ?>;

    vals.forEach(function(e){
    if(!s2.find('option:contains(' + e + ')').length)
      s2.append($('<option>').text(e));
    });

    s2.val(vals).trigger("change");
});
</script>

@endsection
