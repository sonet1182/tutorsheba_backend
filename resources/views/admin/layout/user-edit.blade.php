@extends('admin.master')

@section('title')
    {{ $user->name }} | Admin
    @stop

@section('content')
    <div class="page-heading">
        <h1 class="page-title">{{ $user->name }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/all_user') }}">User List</a></li>
        </ol>

    </div>

    <div class="page-content my-5">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-sm btn-warning" href="{{ url('/admin/all_user') }}"><i class="fa fa-arrow-left"></i> back</a>
                        <h3 class="text-center">{{ $user->name }}</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => '/admin/user-edit','method'=>'POST', 'class'=>'well form-horizontal','id'=>"contact_form"]) !!}
                        <div class="form-group">
                            <div class="form-row">
                              <label class="col-md-3 control-label">User Id :</label>
                              <div class="col-md-6 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input  name="s_email" class="form-control" title="Inter Your Email"  type="number" value="{{ $user->id }}" disabled>
                                </div>
                               </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('s_fullName') ? ' has-error' : '' }}">
                            <div class="form-row">
                                <label class="col-md-3 control-label">Full Name :</label>
                                <div class="col-md-6 col-xs-12 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="s_fullName" class="form-control vtip" title="Input Student full name."   type="text" value="{{ $user->name }}" disabled>
                                        <input  name="id" class="form-control"    type="hidden" value="{{ $user->id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <label class="col-md-3 control-label">E-Mail (optional) :</label>
                                <div class="col-md-6 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input  name="s_email" class="form-control" title="Inter Your Email"  type="email" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <label class="col-md-3 control-label">Phone Number :</label>
                                <div class="col-md-6 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input  name="phoneNumber" class="form-control" title="Inter Your Email"  type="number" value="{{ $user->phoneNumber }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <label class="col-md-3 control-label">Facebook Id :</label>
                                <div class="col-md-6 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input  name="facebook_id" class="form-control" title="Inter Your Email"  type="text" value="{{ $user->facebook_id }}" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <label class="col-md-3 control-label">Approval Id :</label>
                                <div class="col-md-6 inputGroupContainer">
                                    <div class="input-group">
                                        <input  name="approval" class="" type="radio" value="1">Yes
                                        <input  name="approval" class="" type="radio" value="0">No
                                        <i style="margin-left: 20px;font-weight: 900;font-size: 20px">
                                            @if($user->approval==0)
                                                No
                                            @else
                                                Yes
                                            @endif
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-lg" >Submit Request <i class="fa fa-send"></i></button>
                            </div>

                        {!! FORM::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
