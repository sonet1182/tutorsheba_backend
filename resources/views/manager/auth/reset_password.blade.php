@extends('manager.layouts.master')

@section('title')
    Settings | Manager
@stop

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Password Update</h1>
    </div>





    <div class="page-content my-5">
        <div class="row justify-content-md-center">
            <div class="col-md-6">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('message'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('message') }}.
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}.
                    </div>
                @endif

                <div class="card my-5">
                    <div class="card-header">
                        <h4 class="text-center">Reset Password</h4>
                    </div>
                    <div class="card-body parent-request-form">
                        <form method="post" action="{{ url('/manager/reset_password') }}">
                            @csrf

                            <div class="form-group">
                                <label for="old_password">Old Password<span class="text-danger">*</span></label>
                                <input type="password" name="old_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password<span class="text-danger">*</span></label>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password<span class="text-danger">*</span></label>
                                <input type="password" name="confirm_password" class="form-control">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary">Submit <i
                                        class="fa fa-send"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
