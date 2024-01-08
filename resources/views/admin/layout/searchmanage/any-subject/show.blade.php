@extends('admin.master')

@section('content')


    <div class="page-heading">
        <h1 class="page-title">Subject Create</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/any-subject') }}">subject List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/any-subject/create') }}">Create subject</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">AnySubject {{ $anysubject->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/any-subject') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/any-subject/' . $anysubject->id . '/edit') }}" title="Edit AnySubject"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/anysubject', $anysubject->id],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'title' => 'Delete AnySubject',
                                'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr><th>ID</th><td>{{ $anysubject->id }}</td></tr>
                                <tr><th> Medium Name </th><td> {{ $anysubject->mediumName }} </td></tr>
                                <tr><th> Class Name </th><td> {{ $anysubject->className }} </td></tr>
                                <tr><th> SubjectName </th><td> {{ $anysubject->subjectName }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

