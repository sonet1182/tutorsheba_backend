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

                    <div class="card-header">FAQ {{ $faq_data->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/faq-data') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/faq-data/' . $faq_data->id . '/edit') }}" title="Edit FAQ"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/faq-data', $faq_data->id],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'title' => 'Delete FAQ',
                                'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $faq_data->id }}</td>
                                </tr>
                                <tr>
                                    <th>Faq Title</th><td>{{ $faq_data->faq_title }}</td>
                                </tr>
                                <tr><th> Faq Content </th><td> {{ $faq_data->faq_content }} </td></tr>
                                <tr><th> Faq Type </th><td> {{ $faq_data->faq_type }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection





