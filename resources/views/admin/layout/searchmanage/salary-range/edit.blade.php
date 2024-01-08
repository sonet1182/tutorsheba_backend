@extends('admin.master')

@section('content')


    <div class="page-heading">
        <h1 class="page-title">Salary Range</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/salary-range') }}">Salary Range List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/salary-range/create') }}">Create salary range</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Edit salaryRange #{{ $salaryrange->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/salary-range') }}" title="Back"><button class="btn btn-warning btn-xs"><i
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


                        <form class="form-horizontal" action="{{ url('/admin/salary-range/'. $salaryrange->id .'/update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Salary Range</label>
                                <input type="number" class="form-control" name="name" placeholder="00"  value="{{ $salaryrange->salaryRange }}" style="max-width: 200px">
                                <small class="text-danger">Only Enter the Salary Per Month in Number</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection



