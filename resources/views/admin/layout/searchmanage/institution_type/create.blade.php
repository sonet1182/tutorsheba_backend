@extends('admin.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Institute Type</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/institution_type') }}">Institute Type List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/institution_type/create') }}">Create Institute Type</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Create New Institute Type</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/institution_type') }}" title="Back"><button class="btn btn-warning btn-xs"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{ session()->get('status') }}
                            </div>
                        @endif

                        <form action="{{ url('admin/institution_type/store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name:</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Enter Institute Type Name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
