@extends('admin.master')

@section('title')
    Broadcast Notice | Admin Desh Tutor
@stop

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Update Broadcast Notice</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/notice/broadcast') }}">Broadcast Notice</a></li>

        </ol>
    </div>


    @if (session('message'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{ session('message') }}.
        </div>
    @endif

    <div class="page-content">
        <div class="row justify-content-md-center">
            <div class="col-md-10">


                <div class="card mb-5">
                    <div class="card-header">
                        <h4 class="text-center">For Tutors</h4>
                    </div>
                    <div class="card-body parent-request-form">
                        <form method="post" action="{{ url('/admin/notice/broadcast') }}">
                            @csrf

                            <input type="hidden" value="1" name="user"/>



                            <div class="form-group">
                                <label for="ex_info">Text Notice*</label>
                                <textarea name="text" class="form-control" rows="4">{{ $tutor_notice->text }}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary">Submit<i class="fa fa-send"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">For Student/Guardians</h4>
                    </div>
                    <div class="card-body parent-request-form">
                        <form method="post" action="{{ url('/admin/notice/broadcast') }}">
                            @csrf

                            <input type="hidden" value="2" name="user"/>



                            <div class="form-group">
                                <label for="ex_info">Text Notice*</label>
                                <textarea name="text" class="form-control" rows="4">{{ $stu_notice->text }}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary">Submit<i class="fa fa-send"></i></button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
