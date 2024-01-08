@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">HOW IT WORKS</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/howitworks-data') }}">How It Works List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/howitworks-data/create') }}">Create How It Works</a></li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Create New How It Works</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/howitworks-data') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/howitworks-data', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('admin/layout/management.howitworks-data.form')

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



