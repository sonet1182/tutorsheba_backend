@extends('admin.master')

@section('content')


    <div class="page-heading">
        <h1 class="page-title">All Districts</h1>
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
                    <div class="card-header">Edit AnyClass #{{ $anyclass->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/any-class') }}" title="Back"><button class="btn btn-warning btn-xs"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{ session()->get('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" action="{{ url('/admin/any-class/'. $anyclass->id .'/update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Medium Name</label>
                                <select class="form-control" name="medium_id">
                                    @foreach ($allmedium as $medium)
                                        <option value="{{ $medium->id }}" {{ $medium->id == $anyclass->medium_id ? 'selected' : '' }}>{{ $medium->mediumName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Class Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $anyclass->className }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
