@extends('admin.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Slider Images</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/slider') }}">Slider Images</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Slider Images</li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Edit Slider #{{$sliders->id}}</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('admin/slider') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form action="{{ url('/admin/slider/update/' . $sliders->id) }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label for="title">Slider Image Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Please Add A Image Title" value="{{ $sliders->title }}" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="img">Edit Your Imgge</label>
                                        <input type="file" name="img" accept="image*" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="activity" class="form-check-input" {{ $sliders->activity == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="activity">Activity</label>
                                        </div>
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
