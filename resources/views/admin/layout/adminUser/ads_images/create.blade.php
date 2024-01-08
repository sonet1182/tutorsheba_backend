@extends('admin.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Ads Images</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/ads-images') }}">Ads Images</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ads Images Add</li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Add New Ads</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('admin/ads-images') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form action="{{ url('/admin/ads-images/store') }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label for="img">Add Your Imgge</label>
                                        <input type="file" name="img" accept="image*" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="activity" class="form-check-input">
                                            <label class="form-check-label" for="activity">Activity</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="position">Ads Image Position</label>
                                        <select name="position" class="form-control" required>
                                            <option selected="selected" value="">Please Select Ads Image Position</option>
                                            <option value="home_top">Home Top</option>
                                            <option value="home_down">Home Down</option>
                                            <option value="tuition_job">Tuition Job</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-link-label" for="link">Input Ads Link</label>
                                        <input type="url" name="link" class="form-control form-link-input">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
