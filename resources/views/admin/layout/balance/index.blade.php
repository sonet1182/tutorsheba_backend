@extends('admin.master')

@section('title', 'Membership List | Admin')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">All Balance Add List</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item active">All Balance Add List</li>
        </ol>
    </div>

    @if (session('message'))
        <div class="alert alert-danger text-center">
            <h4>{{ session('message') }}</h4>
        </div>
    @endif

    <div class="page-content">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Balance Add List</h3>
                    </div>
                    <div class="card-body">
                        @foreach($member as $adminlist)
                            <div class="row">
                                <div class="row col-md-8">
                                    {{-- <div class="col-md-4">Membership ID:</div><div class="col-md-6">{{ $adminlist->id }}</div>    --}}
                                    <div class="col-md-4">User ID:</div><div class="col-md-6">{{ $adminlist->user_id }}</div>
                                    <div class="col-md-4">Tutor ID:</div><div class="col-md-6">{{ $adminlist->teacher_id }}</div>
                                    <div class="col-md-4">User Name:</div><div class="col-md-6">{{ $adminlist->user->name }}</div>
                                    <div class="col-md-4">Phone Number:</div><div class="col-md-6">{{ $adminlist->user->phoneNumber }}</div>
                                    <div class="col-md-4">Balance Amount:</div><div class="col-md-6">৳ {{ !empty($adminlist->balance) ? $adminlist->balance : '0' }}</div>
                                    <div class="col-md-4">Created Time:</div><div class="col-md-6">{{ $adminlist->created_at }}</div>

                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-info" href="{{ url('/admin/balance/create') }}/{{ $adminlist->id }}"><i class="fa fa-pencil"></i> Edit</a>
                                </div>
                            </div>
                            <br>
                        @endforeach
                        {{ $member->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
