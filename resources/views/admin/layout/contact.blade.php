@extends('admin.master')
@section('title','Guest Contact | TutorSheba')
@section('content')
    <div class="page-heading">
        <h1 class="page-title">Contact Message</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="la la-home font-20"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i>Dashboard</a></li>
        </ol>
    </div>




    @if (session('message'))
    <div class="alert alert-danger alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button><strong>Warning!</strong> {{ session('message') }}.
    </div>
    @endif





    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Contact Message</div>
            </div>
            <div class="ibox-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Time</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>E-Mail</th>
                            <th>Comment</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contact as $message)
                            <tr>
                                <td>{{ $message->id }}</td>
                                <td>{{ date('d M, Y',strtotime($message->created_at)) }} At {{ date('g:ia',strtotime($message->created_at)) }}</td>
                                <td>{{ $message->fast_name.' '.$message->last_name }}</td>
                                <td>{{ $message->phone_number }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->comment }}</td>
                                <td>
                                    <a href="" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Reply"><i class="fa fa-reply font-14"></i></a>
                                    <a href="{{ url('admin/contact-delete') }}/{{ $message->id }}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@endsection
