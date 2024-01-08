@extends('admin.master')

@section('content')
    <div class="content-wrapper">
        <!-- Page header -->
        <div class="page-header">
            <div class="breadcrumb-line">
                <ul class="breadcrumb">
                    <li><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="{{ url('/admin/new_student_request') }}">New student Request</a></li>
                    <li><a href="{{ url('/admin/approval_student_list') }}">Approval student List</a></li>
                    <li><a href="{{ url('/admin/rejected_student_list') }}">Rejected student List</a></li>
                </ul>
                <ul class="breadcrumb-elements">
                    <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-gear position-left"></i>
                            Settings
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                            <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                            <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- /page header -->

        <!-- Content area -->

        <div class="content">


            <div id="wrapper">

                <div id="page-wrapper">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="header">
                            <strong>Request for a tutor! </strong> If you want to get your Desired tutor then fill the below form.
                        </div>
                        {!! Form::open(['url' => 'admin/tuition_request','method'=>'POST', 'class'=>'row form-horizontal','id'=>"contact_form"]) !!}
                        <div class="form-group {{ $errors->has('s_fullName') ? ' has-error' : '' }}">
                            <label class="control-label col-sm-3" for="name">Full Name <span>:</span></label>
                            <div class="col-sm-9">
                                <input  name="s_fullName" class="form-control poshytip" title="Input Student full name."   type="text" value="{{ old('s_fullName') }}">
                                @if ($errors->has('s_fullName'))
                                    <span class="help-block">
                                   <strong>{{ $errors->first('s_fullName') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('s_phoneNumber') ? ' has-error' : '' }}">
                            <label class="control-label col-sm-3" for="number">Phone Number <span>:</span></label>
                            <div class="col-sm-9">
                                <input  name="s_phoneNumber" class="form-control poshytip"  title="Input Your Valid phone number" type="text" value="{{ old('s_phoneNumber') }}">
                                @if ($errors->has('s_phoneNumber'))
                                    <span class="help-block">
                                   <strong>{{ $errors->first('s_phoneNumber') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">E-Mail <small>(optional)</small> :</label>
                            <div class="col-sm-9">
                                <input  name="s_email" class="form-control poshytip" title="Inter Your E-Mail address(optional)"  type="email" value="{{ old('s_email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Student Gender :</label>
                            <div class="col-sm-9">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="s_gender" value="Male" /> Male
                                    </label>
                                    <label style="padding-left: 40px">
                                        <input type="radio" name="s_gender" value="female" /> Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">School / College :</label>
                            <div class="col-sm-9">
                                <input name="s_college" class="form-control poshytip" title="Type Student School/ College Name"  type="text" value="{{ old('s_college') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Select Student Class :</label>
                            <div class="col-sm-9">
                                <select name="s_class" class="form-control class poshytip" title="Select student class">
                                    <option disabled="disabled">Please select Student Class</option>
                                    @foreach($class as $allClass)
                                        <option value="{{ $allClass->className }}" >{{ $allClass->className }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Select Your Medium :</label>
                            <div class="col-sm-9">
                                <select name="s_medium" class="form-control medium" >
                                    <option disabled="disabled">Select your Medium</option>
                                    @foreach($medium as $allMedium)
                                        <option value="{{ $allMedium->mediumName }}">{{ $allMedium->mediumName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('s_districts') ? ' has-error' : '' }}">
                            <label class="control-label col-sm-3" for="email">Select Districts :</label>
                            <div class="col-sm-9">
                                <select name="s_districts" class="form-control district mobileSelect">
                                    <option value="" >Please select your Districts</option>
                                    @foreach($allDistricts as $districts)
                                        <option value="{{ $districts->id }}" >{{ $districts->districtName }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('s_districts'))
                                    <span class="help-block">
                         <strong>{{ $errors->first('s_districts') }}</strong>
                         </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('s_area') ? ' has-error' : '' }}">
                            <label class="control-label col-sm-3" for="email">Select area :</label>
                            <div class="col-sm-9">
                                <div class="selectArea">
                                    <select name="s_area" class="form-control area">
                                        <option value="">select area</option>
                                    </select>
                                    @if ($errors->has('s_area'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('s_area') }}</strong>
                                 </span>
                                    @endif
                                </div>
                                <div class="loadingImg" style="display: none;">
                                    <img class="loding" src="{{ asset('frontPage/images/loader.gif') }}">
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email"> Adress Details :</label>
                            <div class="col-sm-9">
                                <textarea rows="4" class="form-control" name="s_address" placeholder="Preferred Areas to Teach"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Select Teacher Gender:</label>
                            <div class="col-sm-9">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="t_gender" value="Any Gender" /> Any Gender
                                    </label>
                                    <label style="padding-left: 50px">
                                        <input type="radio" name="t_gender" value="Male" /> Male
                                    </label>
                                    <label style="padding-left: 50px">
                                        <input type="radio" name="t_gender" value="Female" /> Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_subject') ? ' has-error' : '' }}">
                            <label class="control-label col-sm-3" for="email">Select Subject:</label>
                            <div class="col-sm-9">
                                <select name="t_subject[]" class="form-control subject-multiple vtip" title="Please Select Subject*" multiple="multiple">
                                    <option disabled="disabled">Select Subject</option>
                                    @foreach($subject as $allSubject)
                                        <option value="{{ $allSubject->subjectName }}" class="text-uppercase">{{ $allSubject->subjectName }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('t_subject'))
                                    <span class="help-block">
                         <strong>{{ $errors->first('t_subject') }}</strong>
                         </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Days Per Week:</label>
                            <div class="col-sm-9">
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
                            <label class="control-label col-sm-3" for="email">Salary Range:</label>
                            <div class="col-sm-9">
                                <select name="t_salary" class="form-control salaryRange">
                                    <option value="" >Please select Salary Range</option>
                                    @foreach($salary as $allSalary)
                                        <option value="{{ $allSalary->salaryRange }}" >{{ $allSalary->salaryRange }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-sm-3">NID Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control poshytip" id="nid" name="nid_number" title="input NID number | don't wory, this NID number only show admin" value="{{ old('nid_number') }}" placeholder="nid number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-xs-3 control-label"></label>
                            <div class="col-md-4 col-xs-9 btn-lg">
                                <button type="submit" id="sign" class="btn btn-info btn-lg" >Submit Request</button>
                            </div>
                        </div>
                        {!! FORM::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
