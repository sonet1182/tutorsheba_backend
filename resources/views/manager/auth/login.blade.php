<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Manager Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <img src="{{ asset('img/logo.png') }}" alt="logo"/>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="container my-10">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="card-header bg-custom text-center">{{ __('Login As Manager') }}
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('manager.login') }}" class="mt-4 mb-3">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-end">{{ __('E-Mail/Phone') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="text"
                                            placeholder="Enter Email or Phone Number..."
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" placeholder="Enter Your Password..." type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif

                                        <button type="submit" class="btn btn-success w-100 mt-3">
                                            <i class="fa fa-sign-in"></i> {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
