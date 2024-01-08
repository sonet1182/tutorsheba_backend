@extends('frontend.layouts.master2')

@section('content')
    <div class="container my-10">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="card-header bg-custom text-center text-light">{{ __('Login for Admin') }}</div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.login') }}" class="mt-4 mb-3">
                            @csrf
                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail/Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" placeholder="Enter Email or Phone Number..."
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                        value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" placeholder="Enter Your Password..." type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                                    <button type="submit" class="btn btn-info w-100 mt-3">
                                        <i class="fa fa-sign-in"></i> {{ __('Login') }}
                                    </button>
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <div class="col-md-6 offset-md-4 row">
                                    <div class="form-check col-md-6">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                    <div class="col-md-6">
                                        <a class="" href="{{ url('/register') }}">Create New Account</a>
                                    </div>
                                </div>
                            </div> --}}


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
