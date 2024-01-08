@extends('admin.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Add Admin</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/admin') }}"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add Admin</li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/admin-list') }}">Admin List</a></li>
        </ol>

    </div>





    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Admin New User Create</h4>
                    </div>
                    @if (session('adminUser'))
                        <div class="alert alert-danger text-center">
                            <h4>{{ session('adminUser') }}</h4>
                        </div>
                    @endif
                    {!! Form::open(['url' => '/admin/admin','method'=>'POST', 'class'=>'card-body form-horizontal']) !!}
                    <div class="form-group {{ $errors->has('secretCode') ? ' has-error' : '' }}">
                        <label class="control-label">Secrate Code<span class="">*</span> </label>
                        <div class="controls">
                            <input type="password" class="form-control" name="secretCode" data-toggle="tooltip" title="Inter your carrent password" value="{{ old('secretCode') }}"/>
                            @if ($errors->has('secretCode'))
                                <span class="help-block">
                        <strong>{{ $errors->first('secretCode') }}</strong>
                     </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="control-label ">Full Name<span class="">*</span> </label>
                        <div class="controls">
                            <input type="text" class="form-control" name="name" data-toggle="tooltip" title="Inter your carrent name" value="{{ old('name') }}"/>
                            @if ($errors->has('name'))
                                <span class="help-block">
                             <strong>{{ $errors->first('name') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="control-label">Email<span class="">*</span> </label>
                        <div class="controls">
                            <input type="email" class="form-control" name="email" data-toggle="tooltip" title="Inter your valid email" value="{{ old('email') }}"/>
                            @if ($errors->has('email'))
                                <span class="help-block">
                             <strong>{{ $errors->first('email') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="control-label">New password<span class="">*</span> </label>
                        <div class="controls">
                            <input type="password" class="form-control" name="password" data-toggle="tooltip" title="Inter Your new password" value="{{ old('password') }}"/>
                            @if ($errors->has('password'))
                                <span class="help-block">
                               <strong>{{ $errors->first('password') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('con_password') ? ' has-error' : '' }}">
                        <label class="control-label">Confirm password<span class="">*</span> </label>
                        <div class="controls">
                            <input type="password" class="form-control" name="con_password" data-toggle="tooltip" title="confirm password" value="{{ old('con_password') }}"/>
                            @if ($errors->has('con_password'))
                                <span class="help-block">
                               <strong>{{ $errors->first('con_password') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-info pull-right">Submit</button>
                    {!!  FORM::close() !!}
                </div>
            </div>
        </div>
    </div>





















@endsection
