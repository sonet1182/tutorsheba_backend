<div class="card mb-3">
    <div class="row">
        <div class="col-md-2 col-sm-5 col-xs-12 text-center">
            <a href="{{ url('/tutor_details') }}/{{ $teacher->teacher->teacher_id }}">

                <img class="styleBorderImg" src="{{ asset($teacher->teacher->teacher_profile_picture) }}"
                    alt="{{ $teacher->name }}"
                    onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/teacher/icons/instagram-ui-twotone/48/Paul-18-512.png';" /></a>
            <br>
            <strong>ID # {{ $teacher->teacher->teacher_id }} </strong>
        </div>
        <div class="col-md-4 col-sm-7 col-xs-12"> <strong><span class="text-info">
                    {{ $teacher->name }} </span></strong> <br>
            <span style="color: green;"> Member Since: {{ $teacher->teacher->created_at->format('d-M-Y') }} </span>
            <br>

            <div>
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


                                        @if ($teacher->teacher->home_approval == 1)
                                            <span class="badge badge-pill badge-danger px-4"><i
                                                    class="fa fa-heart font-14"></i> Premium</span>
                                        @endif
            </div>

            <span>{{ $teacher->teacher->tuition_salary }}</span> <br>
            <strong>Qualification:</strong> {{ $teacher->teacher->teacher_degree }} <br>
            <strong>Honours Ins:</strong> {{ $teacher->teacher->honours_institute }} <br>
            <strong>Tuition Me:</strong> {{ $teacher->teacher->tuition_medium }} <br>
            <strong>Teaching:</strong> {{ $teacher->teacher->tuition_subject }}
            <br><br>

            <strong>Applied:</strong> {{ $teacher->created_at->format('h:i A | d-M-Y') }}
        </div>
        <div class="col-md-3 space-htop">
            <strong>{{ $teacher->teacher->districts ? $teacher->teacher->districts->districtName : '' }}
                <br></strong> <span class="text-lowercase">{{ $teacher->teacher->tuition_area }}</span>
        </div>
        <div class="col-md-3">
            <a href="{{ url('/admin/teacher_details') }}{{ $teacher->teacher->user_id }}"
                class="btn btn-lg btn-info mt-2">View Details</a>


                <button type="button" class="btn btn-lg btn-primary mt-2" data-toggle="modal"
                                        data-target="#exampleModal{{ $teacher->teacher->id }}" {{ $confirmed == '1' ? 'disabled' : ''}}>
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        Assign Teacher
                                    </button>
        </div>
        <div class="col-sm-12 ml-2 mb-1">
            <strong>Experience:</strong> {{ $teacher->teacher->tuition_experience }}
        </div>
    </div>
</div>

<!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $teacher->teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <form action="{{ url('admin/assign_teacher') }}" method="post">
                                            @csrf
                                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}"/>
                                        <input type="hidden" name="student_id" value="{{ $student_id }}"/>
                                          <div class="form-group">
                                            <h5 for="exampleInputEmail1">Are you sure to assign him/her?</h5>
                                            <hr>
                                            <input name="assigned_by" class="form-control my-2" placeholder="Assigned By"  required="required">
                                            <textarea placeholder="Enter remark..." class="form-control" name="remark" rows="5"></textarea>
                                          </div>
                                          <button type="submit" class="btn btn-lg btn-outline-primary px-4">Submit</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
