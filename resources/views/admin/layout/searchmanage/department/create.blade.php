@extends('admin.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Department</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/department') }}">Department List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/department/create') }}">Create Department</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create New Department</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/department') }}" title="Back"><button class="btn btn-warning btn-xs"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{ session()->get('status') }}
                            </div>
                        @endif

                        <form action="{{ url('admin/department/store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Study Type:</label>
                                    <select class="form-control" name="type_id" required>
                                        <option value="">Select One</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name:</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Enter Department Name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
