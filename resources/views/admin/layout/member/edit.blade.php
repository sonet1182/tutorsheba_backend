@extends('admin.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Tutor ID: {{ $tutor->tutor->teacher_id }} Premium Membership Edit</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/membership') }}">Membeship List</a></li>
            <li class="breadcrumb-item">Membeship Edit</li>
        </ol>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <div class="page-content">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">

                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => '/admin/membership/update/'.$tutor->id,'method'=>'POST', 'class'=>'well form-horizontal']) !!}
                        <div class="form-group {{ $errors->has('plan_id') ? ' has-error' : '' }}">
                            <label class="control-label col-sm-3 col-xs-12">Plan ID</label>
                            <div class="controls col-sm-12 col-xs-12">
                                <select class="form-control" name="plan_id">
                                    <option value="1" {{ $tutor->plan_id == 1 ? "selected" : ''}}>Plan 1 30 days</option>
                                    <option value="2" {{ $tutor->plan_id == 2 ? "selected" : ''}}>Plan 2 90 days</option>
                                    <option value="3" {{ $tutor->plan_id == 3 ? "selected" : ''}}>Plan 3 180 days</option>
                                </select>
                                @if ($errors->has('plan_id'))
                                    <span class="help-block">
                             <strong>{{ $errors->first('plan_id') }}</strong>
                             </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label class="control-label col-sm-3 col-xs-12">Amount</label>
                            <div class="controls col-sm-12 col-xs-12">
                                <input type="text" class="form-control" name="amount" value="{{ !empty($tutor->amount) ? $tutor->amount : '0' }}" placeholder="amount">
                                @if ($errors->has('amount'))
                                    <span class="help-block">
                             <strong>{{ $errors->first('amount') }}</strong>
                             </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('home_approval') ? ' has-error' : '' }}">
                            <label class="control-label col-sm-3 col-xs-12">Home Approval</label>
                            <div class="controls col-sm-12 col-xs-12">
                                <select class="form-control" name="home_approval">
                                    <option value="0" {{ $tutor->home_approval == 0 ? 'selected' : ''}}>No</option>
                                    <option value="1" {{ $tutor->home_approval == 1 ? 'selected' : ''}}>Yes</option>
                                </select>
                                @if ($errors->has('home_approval'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('home_approval') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('user_id') ? ' has-error' : '' }}">
                            <label class="control-label col-sm-3 col-xs-12">User Id</label>
                            <div class="controls col-sm-12 col-xs-12">
                                <select class="form-control" name="user_id">
                                    <option value="{{ $tutor->user_id }}">{{ $tutor->user_id }}</option>
                                </select>
                                @if ($errors->has('user_id'))
                                    <span class="help-block">
                             <strong>{{ $errors->first('user_id') }}</strong>
                             </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('tutor_id') ? ' has-error' : '' }}">
                            <label class="control-label col-sm-3 col-xs-12">Tutor Id</label>
                            <div class="controls col-sm-12 col-xs-12">
                                <select class="form-control" name="tutor_id">
                                    <option value="{{ $tutor->tutor_id }}">{{ $tutor->tutor_id }}</option>
                                </select>
                                @if ($errors->has('tutor_id'))
                                    <span class="help-block">
                             <strong>{{ $errors->first('tutor_id') }}</strong>
                             </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-lg btn-success">Save</button>
                        </div>
                        {!!  FORM::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
