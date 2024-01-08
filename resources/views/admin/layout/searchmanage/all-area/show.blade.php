@extends('admin.master')

@section('content')



    <div class="page-heading">
        <h1 class="page-title">All Districts</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/all-area') }}">Area List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/all-area/create') }}">Create Area</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">AllArea {{ $allarea->id }}</h3>
                    </div>
                    <div class="card-body">

                        <a href="{{ url('/admin/all-area') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/all-area/' . $allarea->id . '/edit') }}" title="Edit AllArea"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/allarea', $allarea->id],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'title' => 'Delete AllArea',
                                'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $allarea->id }}</td>
                                </tr>
                                <tr><th> District Name </th>
                                <td>
                                    @if(isset($allarea->all_districts->districtName))
                                        {{  $allarea->all_districts->districtName }}
                                    @else
                                        {{ '----' }}
                                    @endif
                                </td>
                                </tr><tr><th> Area Name </th><td> {{ $allarea->areaName }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection






