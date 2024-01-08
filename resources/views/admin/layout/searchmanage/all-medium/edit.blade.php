@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">All Districts</h1>
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
                        <h3 class="text-content">Edit AllMedium #{{ $allmedium->id }}</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/admin/all-medium') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{ session()->get('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" action="{{ url('/admin/all-medium/'. $allmedium->id .'/update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Medium Name</label>
                                <input type="text" class="form-control" value="{{ $allmedium->mediumName }}" name="name">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
