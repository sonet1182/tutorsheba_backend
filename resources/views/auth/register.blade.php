@extends('frontend.layouts.master')

@section('content')
    <div class="sign_in_up_bg">
        <div class="container">
            <div class="row justify-content-lg-center justify-content-md-center">
                <div class="col-lg-8 col-md-9">
                    <div class="sign_form">
                        <div class="main-tabs">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a href="#instructor-signup-tab" id="instructor-tab" class="nav-link active"
                                        data-toggle="tab">Tutor</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#student-signup-tab" id="student-tab" class="nav-link"
                                        data-toggle="tab">Gurdian/Student</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="instructor-signup-tab" role="tabpanel"
                                aria-labelledby="instructor-tab">
                                <h3>Sign Up as a Tutor!</h3>
                                <form method="POST" action="{{ route('register') }}" class="mt-4 mb-3">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="name"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-9">
                                            <input id="name" type="text"
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                name="name" value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                        <div class="col-md-9">
                                            <input id="phoneNumber" type="text"
                                                class="form-control{{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                                name="phoneNumber" value="{{ old('phoneNumber') }}" required>

                                            @if ($errors->has('phoneNumber'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phoneNumber') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email"
                                            class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-9">
                                            <input id="email" type="email"
                                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Gender') }}</label>

                                        <div class="col-md-9">

                                            <select class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}"
                                                name="teacher_gender" required>
                                                <option value="">Select One</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>

                                            @if ($errors->has('gender'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-md-3 col-form-label text-md-right">Tuition
                                            districts:</label>
                                        <div class="col-md-9">
                                            <select name="district_id" class="form-control districts single-select">
                                                <option value="">Select Your Districts</option>
                                                @foreach ($allDistrict as $districts)
                                                    <option value="{{ $districts->id }}">{{ $districts->districtName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-md-3 col-form-label text-md-right">Tuition
                                            Area:</label>
                                        <div class="col-md-9">
                                            <div class="selectArea">
                                                <select name="tuition_area[]"
                                                    class="form-control area area-m-select required"
                                                    title="select preferred tuition area" multiple="multiple" required>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Select tuition provide area
                                                </div>
                                            </div>

                                            </select>
                                            <div class="loadingImg" style="display: none;">
                                                <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}"
                                                    alt="TutorSheba" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="password"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-9">
                                            <input id="password" type="password"
                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-9">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required>
                                        </div>
                                    </div>

                                    <button class="login-btn" type="submit">
                                        Sign Up as a Tutor
                                    </button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="student-signup-tab" role="tabpanel"
                                aria-labelledby="student-tab">
                                <h3>Sign Up as a Gurdian/Student!</h3>
                                <form>
                                    <div class="ui search focus mt-15">
                                        <div class="ui form swdh30">
                                            <div class="field">
                                                <textarea rows="3" name="description" id="id_about1" placeholder="Write a little description about you..."></textarea>
                                            </div>
                                        </div>
                                        <div class="help-block">
                                            Your biography should have at least 12000 characters.
                                        </div>
                                    </div>
                                    <button class="login-btn" type="submit">
                                        Student Sign Up Now
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="mb-0 mt-30">
                            Already have an account? <a href="sign_in.html">Log In</a>
                        </p>
                    </div>
                    <div class="sign_footer">
                        <img src="images/sign_logo.png" alt="" />© 2020
                        <strong>Cursus</strong>. All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
