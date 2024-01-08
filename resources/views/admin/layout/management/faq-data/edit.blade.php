@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">FAQ</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/faq-data') }}">Faq List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/faq-data/create') }}">Create Faq</a></li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">Edit Faq #{{ $faq_data->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/faq-data') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($faq_data, [
                            'method' => 'PATCH',
                            'url' => ['/admin/faq-data', $faq_data->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin/layout/management.faq-data.form', ['submitButtonText' => 'Update'])

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
