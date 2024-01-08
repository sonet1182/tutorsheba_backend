@extends('admin.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Study Type</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/study_type') }}">Study Type List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/study_type/create') }}">Create Study Type</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>

    @if (session()->has('status'))
        <div class="alert alert-success">
            {{ session()->get('status') }}
        </div>
    @endif


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">Study Type</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/study_type/create') }}" class="btn btn-success btn-sm float-right mb-4"
                            title="Add New Study Type">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br />
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Study Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($study_type as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                {{-- <a href="{{ url('/admin/study_type/show/' . $item->id) }}"
                                                    title="View Study Type"><button class="btn btn-info btn-xs"><i
                                                            class="fa fa-eye" aria-hidden="true"></i> View</button></a> --}}
                                                <a href="{{ url('/admin/study_type/edit/' . $item->id) }}"
                                                    title="Edit Study Type"><button class="btn btn-primary btn-xs"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Edit</button></a>
                                                <a onclick="return confirm('Are you sure you want to delete this item?');"
                                                    href="{{ url('/admin/study_type/delete/' . $item->id) }}"
                                                    title="Delete Study Type"><button class="btn btn-danger btn-xs"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i>
                                                        Delete</button></a>

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
