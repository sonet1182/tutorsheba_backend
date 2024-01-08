@extends('admin.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Tutor ID: {{ $tutor->teacher_id }} Add Balance</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/alladdbalance') }}">All Balance Add List</a></li>
            <li class="breadcrumb-item">Balance Add</li>
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
                        {!! Form::open(['url' => '/admin/balance/store/'.$tutor->id,'method'=>'POST', 'class'=>'well form-horizontal']) !!}

                        <div class="form-group {{ $errors->has('balance') ? ' has-error' : '' }}">
                            <label class="control-label col-sm-3 col-xs-12">Add Balance Amount</label>
                            <div class="controls col-sm-12 col-xs-12">
                                <input type="text" class="form-control" name="balance" value="{{ !empty($tutor->balance) ? $tutor->balance : '0' }}" placeholder="balance">
                                @if ($errors->has('balance'))
                                    <span class="help-block">
                             <strong>{{ $errors->first('balance') }}</strong>
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
