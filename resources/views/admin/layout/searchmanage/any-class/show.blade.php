@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Class List</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/any-class') }}">Class List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/any-class/create') }}">Create Class</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">AnyClass {{ $anyclass->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/any-class') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/any-class/' . $anyclass->id . '/edit') }}" title="Edit AnyClass"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/anyclass', $anyclass->id],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'title' => 'Delete AnyClass',
                                'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr><th>ID</th><td>{{ $anyclass->id }}</td></tr>
                                <tr><th> Medium Name </th>
                                <td>
                                    @if(isset($anyclass->all_media->mediumName))
                                        {{  $anyclass->all_media->mediumName }}
                                    @else
                                        {{ '----' }}
                                    @endif
                                </td>
                                </tr>
                                <tr><th> ClassName </th><td> {{ $anyclass->className }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
