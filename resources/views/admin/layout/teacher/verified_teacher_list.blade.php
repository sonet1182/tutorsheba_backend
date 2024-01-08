@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Verified Teacher List (Total: {{ number_format($total) }})</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item active">New Request</li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/home_approval_teacher') }}">Home Approval</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/approval_teacher_list') }}">Approval</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/rejected_teacher_list') }}">Rejected</a></li>
        </ol>
    </div>

    <div class="page-content my-5">
        <div class="row">
                  @foreach($teacherProfile as $teacher)
                     <div class="col-md-4 mb-3">
                      <a href="{{ url('admin/teacher_details') }}{{ $teacher->id }}" class="card">
                          <div class="text-dark p-2">
                              <div class="row">
                                  <div class="col-5">


                                      <img width="100" class="styleBorderImg" src="{{ asset($teacher->teacher->teacher_profile_picture) }}"
                                        alt="{{ $teacher->id }}"
                                        onerror="this.onerror=null;this.src='{{ asset('img/icon/user1.png') }}'" />


                                        @if ($teacher->teacher)
                                        <h5 class="mt-1">Area:
                                            <b>{{ $teacher->teacher->districts ? $teacher->teacher->districts->districtName : '' }}</b>
                                        </h5>
                                    @endif



                                      <h5 class="text-success">ID#{{ $teacher->id }}</h5>


                                      <h5>{{ $teacher->teacher ? $teacher->teacher->districtName : '' }}</h5>



                                  </div>
                                  <div class="col-7">
                                      <h5 class="mt-0">{{ $teacher->name }}</h5>
                                      <p>{{ $teacher->phoneNumber }}</p>


                                    @if($teacher->teacher)
                                      <p class="mb-0">{{ $teacher->teacher->honours_institute ? $teacher->teacher->honours_institute : $teacher->teacher->teacher_university }}
                                      <p class="mb-0">{{ $teacher->teacher->honours_subject ? $teacher->teacher->honours_subject : $teacher->teacher->teacher_subject }}
                                    @endif



                                      <div class="mt-2">
                                        @if ($teacher->approval == 1)
                                            <span class="badge badge-pill badge-success px-4">Approved</span>
                                        @elseif($teacher->approval == 3)
                                            <span class="badge badge-pill badge-danger px-4">Rejected</span>
                                        @else
                                            <span class="badge badge-pill badge-warning px-4">Pending</span>
                                        @endif

                                        @if ($teacher->verified == 1)
                                            <span class="badge badge-pill badge-primary px-4"><i
                                                    class="fa fa-star font-14"></i> Verified</span>
                                        @endif


                                        @if ($teacher->teacher && $teacher->teacher->home_approval == 1)
                                            <span class="badge badge-pill badge-danger px-4"><i
                                                    class="fa fa-heart font-14"></i> Premium</span>
                                        @endif
                                    </div>
                                  </div>


                              </div>
                              <h6 class="text-primary text-center">
                                          {{ $teacher->created_at->format('h:i A | d M,Y') }}
                                        </h6>
                          </div>
                      </a>
                      </div>
                  @endforeach




        </div>
        <div class="pull-right">
                    {{ $teacherProfile->links() }}
                </div>
    </div>
    @endsection
