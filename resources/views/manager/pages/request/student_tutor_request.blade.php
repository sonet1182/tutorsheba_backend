@extends('manager.layouts.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Tutor Request By Parents</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/teacher_tuition_request') }}">Teacher Tuition Request</a></li>
                <li class="breadcrumb-item active" aria-current="page">Student Tutor Request</li>
            </ol>
        </nav>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="ibox">
                    <div class="ibox-body">
                        @foreach($tutorRequest as $tutors)
                            <div class="list-group py-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Teacher Information</h4>
                                        <div class="row">
                                            <div class="col-md-3"> Request Time: </div>
                                            <div class="col-md-9"> <strong class="bg-info text-size-large">{{ $tutors->created_at }}</strong> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"> Teacher ID: </div>
                                            <div class="col-md-9"> <a href="{{ url('/admin/teacher_details'.$tutors->user_id) }}" target="_blank" class="text-bold">{{ $tutors->teacher_id }}</a> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"> Full Name:</div>
                                            <div class="col-md-9"> <strong>{{ $tutors->name }}</strong> </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3"> Phone Number :</div>
                                            <div class="col-md-9"> <strong>{{ $tutors->phoneNumber }}</strong> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"> <strong>Email:</strong> </div>
                                            <div class="col-md-9"> <strong>{{ $tutors->email }}</strong> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Request Information</h4>
                                        <div class="row">
                                            <div class="col-md-3"> Full Name:</div>
                                            <div class="col-md-9"> <strong>{{ $tutors->request_name }}</strong> </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3"> Number : </div>
                                            <div class="col-md-9"> <strong>{{ $tutors->request_phoneNumber }}</strong> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">Email:</div>
                                            <div class="col-md-9"> <strong>{{ $tutors->request_email }}</strong> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"> Message :</div>
                                            <div class="col-md-9"> <strong>{{ $tutors->request_info }}</strong> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="pull-right">
                            {{ $tutorRequest->links() }}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
