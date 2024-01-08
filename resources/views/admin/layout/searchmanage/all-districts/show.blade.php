@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Districts Show {{ $alldistrict->id }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/all-districts') }}">Districts List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/all-districts/create') }}">Create Districts</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>


    <div class="page-content fade-in-up my-5">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Districts Show {{ $alldistrict->id }}</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/admin/all-districts') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/all-districts/' . $alldistrict->id . '/edit') }}" title="Edit AllDistrict"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/alldistricts', $alldistrict->id],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'title' => 'Delete AllDistrict',
                                'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $alldistrict->id }}</td>
                                </tr>
                                <tr><th> DistrictName </th><td> {{ $alldistrict->districtName }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


