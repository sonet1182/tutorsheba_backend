@extends('admin.master')

@section('content')


    <div class="page-heading">
        <h1 class="page-title">All Medium</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/all-medium') }}">medium List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/all-medium/create') }}">Create medium</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('/admin/all-medium/create') }}" class="btn btn-success btn-sm" title="Add New AllMedium">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    </div>
                    <div class="card-body">

                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{ session()->get('status') }}
                            </div>
                        @endif


                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable">
                                <thead>
                                <tr>
                                    <th>ID</th><th>MediumName</th><th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allmedium as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->mediumName }}</td>
                                        <td>
                                            <a href="{{ url('/admin/all-medium/' . $item->id) }}" title="View Medium"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/all-medium/' . $item->id . '/edit') }}" title="Edit Medium"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            <a href="{{ url('/admin/all-medium/' . $item->id . '/delete') }}" title="Delete Medium"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-square-o" aria-hidden="true"></i> Delete</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
