@extends('admin.master')

@section('content')


    <div class="page-heading">
        <h1 class="page-title">Subject List</h1>
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
                    <div class="card-header">
                        <a href="{{ url('/admin/any-subject/create') }}" class="btn btn-success btn-sm" title="Add New AnySubject">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable">
                                <thead>
                                <tr>
                                    <th>ID</th><th>Medium Name</th><th>Class Name</th><th>SubjectName</th><th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($anysubject as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->mediumName }}</td>
                                        <td>{{ $item->className }}</td>
                                        <td>{{ $item->subjectName }}</td>
                                        <td>
                                            <a href="{{ url('/admin/any-subject/' . $item->id . '/edit') }}" title="Edit AnySubject"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            <a href="{{ url('/admin/any-subject/' . $item->id . '/delete') }}" title="delete AnySubject"><button class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></a>
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
