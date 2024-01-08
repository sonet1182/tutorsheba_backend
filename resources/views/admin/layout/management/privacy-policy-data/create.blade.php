@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">PRIVACY POLICY</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/howitworks-data') }}">Add Privacy Policy</a></li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Create Privacy Policy</div>
                    <div class="card-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if (session('flash_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('flash_message') }}.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        {!! Form::model($privacypolicy_data, [
                            'method' => 'post',
                            'url' => ['/admin/privacy-policy/update', $privacypolicy_data->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        <div class="form-group {{ $errors->has('privacy_title') ? 'has-error' : ''}}">
                            {!! Form::label('privacy_title', 'Privacy Policy Title', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-12">
                                {!! Form::text('privacy_title', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('privacy_title', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('privacy_content') ? 'has-error' : ''}}">
                            {!! Form::label('privacy_content', 'Privacy Policy Content', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-12">
                                {!! Form::textarea('privacy_content', null, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text']) !!}
                                {!! $errors->first('privacy_content', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection



