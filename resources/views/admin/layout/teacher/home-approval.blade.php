@extends('admin.master')

@section('content')


    <div class="page-heading">
        <h1 class="page-title">Home Approval Teacher</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/new_teacher_request') }}">New Request</a></li>
            <li class="breadcrumb-item active">Home Approval</li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/approval_teacher_list') }}">Approval</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/rejected_teacher_list') }}">Rejected</a></li>
        </ol>
    </div>

    <div class="page-content my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card-columns">
                  @foreach($teacherProfile as $teacher)
                      <a href="{{ url('admin/teacher_details') }}{{ $teacher->user->id }}" class="card">
                          <div class="text-dark p-2">
                              <div class="row">
                                  <div class="col-5">

                                      <img width="100" class="styleBorderImg" src="{{ asset($teacher->teacher_profile_picture) }}"
                                        alt="{{ $teacher->id }}"
                                        onerror="this.onerror=null;this.src='{{ asset('img/icon/user1.png') }}'" />

                                      <h5 class="text-success">ID#{{ $teacher->teacher_id }}</h5>
                                      <h5>{{ $teacher->districtName }}</h5>
                                  </div>
                                  <div class="col-7">
                                      <h5 class="mt-0">{{ $teacher->teacher_name }}</h5>
                                      <p>{{ $teacher->user->phoneNumber }}</p>
                                      <h6 class="text-muted">{{ $teacher->honours_institute ? $teacher->honours_institute : $teacher->teacher_university }}</h6>
                                      <p class="mb-0">{{ $teacher->honours_subject ? $teacher->honours_subject : $teacher->teacher_subject }}</p>
                                      <div class="mt-2">

                                        <span class="badge badge-pill badge-danger px-4"><i
                                            class="fa fa-heart font-14"></i> Premium</span>
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </a>
                  @endforeach
                </div>
                <div class="pull-right">
                    {{ $teacherProfile->links() }}
                </div>

            </div>
        </div>
    </div>







@endsection
