@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Slider Images</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Slider Images</li>
            <li class="breadcrumb-item"><a href="{{ url('admin/slider/add') }}">Slider Images Add</a></li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <h1 class="text-center" style="font-weight: 900">Slider Images List</h1>
                @if (session('message'))
                    <div class="alert alert-success text-center">
                        <h4>{{ session('message') }}</h4>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-danger text-center">
                        <h4>{{ session('warning') }}</h4>
                    </div>
                @endif
                <a href="{{ url('admin/slider/add') }}" class="btn btn-primary">
                    Add New Slider
                </a>
                <br>
                <hr>
                @foreach($sliders as $adminlist)
                    <div class="row">
                        <div class="col-md-4">ID:</div><div class="col-md-6">{{ $adminlist->id }}</div>
                        <div class="col-md-4">Title:</div><div class="col-md-6">{{ $adminlist->title }}</div>
                        <div class="col-md-4">Created Time:</div><div class="col-md-6">{{ $adminlist->created_at }}</div>
                        <div class="col-md-4">Images:</div><div class="col-md-6">
                            <img width="120" src="{{ asset($adminlist->img) }}" alt="">
                        </div>
                        <div class="col-md-4">Activity:</div><div class="col-md-6">{{ $adminlist->activity }}</div>
                        <div class="col-md-4"></div>
                        <div class="col-md-6">
                            <a href="{{ url('/admin/slider/edit/' . $adminlist->id) }}" class="btn btn-primary">Edit</a>
                            <a class="btn btn-danger" href="{{ url('/admin/slider/delete/' . $adminlist->id) }}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
@endsection
