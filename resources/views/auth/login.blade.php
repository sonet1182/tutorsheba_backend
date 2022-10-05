@extends('frontend.layouts.master')

@section('content')
    <div class="sign_in_up_bg">
        <div class="container">
            <div class="row justify-content-lg-center justify-content-md-center">
                <div class="col-lg-6 col-md-8">
                    <div class="sign_form">
                        <h2>Sign In</h2>
                        <p>Log In to Your Tutorsheba Account!</p>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="ui search focus mt-15">





                                <div class="ui left icon input swdh95">
                                    <input
                                        class="prompt srch_explore text-center {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        type="text" name="email" value="{{ old('email') }}" required autofocus
                                        id="email" required="" maxlength="64"
                                        placeholder="Enter Email or Phone Number..." />

                                    <i class="uil uil-envelope icon icon2"></i>
                                </div>
                                <div class="ui left icon input swdh95">
                                    @if ($errors->has('email'))
                                            <span class="ui form mt-15 text-danger text-center" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>


                            </div>
                            <div class="ui search focus mt-15">
                                <div class="ui left icon input swdh95">
                                    <input
                                        class="prompt srch_explore text-center {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        type="password" name="password" value="" id="password" required=""
                                        maxlength="64" placeholder="Enter Your Password..." />
                                    <i class="uil uil-key-skeleton-alt icon icon2"></i>
                                </div>
                            </div>

                            <div class="ui left icon input swdh95">
                                @if ($errors->has('password'))
                                        <span class="ui form mt-15" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="ui form mt-30 checkbox_sign">
                                <div class="inline field">
                                    <div class="ui checkbox mncheck">
                                        <input type="checkbox" tabindex="0" class="hidden" />
                                        <label>Remember Me</label>
                                    </div>
                                </div>
                            </div>
                            <button class="login-btn" type="submit">Sign In</button>
                        </form>
                        <p class="sgntrm145">
                            Or <a href="forgot_password.html">Forgot Password</a>.
                        </p>
                        <p class="mb-0 mt-30 hvsng145">
                            Don't have an account? <a href="sign_up.html">Sign Up</a>
                        </p>
                    </div>
                    <div class="sign_footer">
                        <img src="images/sign_logo.png" alt="" />© 2018
                        <strong>Tutorshebsa</strong>. All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
