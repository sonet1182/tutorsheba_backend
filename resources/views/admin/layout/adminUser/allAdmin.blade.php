@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Admin List</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/admin') }}"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Admin List</li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/admin-add') }}">Add Admin</a></li>
        </ol>
    </div>





    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                 <h1 class="text-center" style="font-weight: 900">All Admin List</h1>
                    @if (session('message'))
                        <div class="alert alert-danger text-center">
                            <h4>{{ session('message') }}</h4>
                        </div>
                    @endif
            <br>
             @foreach($admin as $adminlist)
                <div class="row">
                        <div class="col-md-4">ID:</div><div class="col-md-6">{{ $adminlist->id }}</div>
                        <div class="col-md-4">Created Time:</div><div class="col-md-6">{{ $adminlist->created_at }}</div>
                        <div class="col-md-4">Name:</div><div class="col-md-6">{{ $adminlist->name }}</div>
                        <div class="col-md-4">Email:</div><div class="col-md-6">{{ $adminlist->email }}</div>
                        <div class="col-md-4">Password:</div><div class="col-md-6">{{ $adminlist->password }}</div>
                    <br>
                        <div class="col-md-4"></div>
                        <div class="col-md-6">
                            <a class="btn btn-info" href="">Edit</a>
                            <a class="btn btn-danger" href="{{ url('admin/admin-delete') }}/{{ $adminlist->id }}">Delite</a>
                        </div>
                </div>
                <hr>
            @endforeach
            </div>
        </div>
    </div>



@endsection
