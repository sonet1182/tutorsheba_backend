@extends('manager.layouts.master')


@section('title', 'Approval Tuition | Admin')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Approval Tuition</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/manager/new_student_request') }}">New Request</a></li>
            <li class="breadcrumb-item active">Approval</li>
            <li class="breadcrumb-item"><a href="{{ url('/manager/rejected_student_list') }}">Rejected</a></li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-md-6 ">

                            <form action="{{ url('manager/tuition_search_by_id') }}" method="POST" class="row">
                                @csrf
                                <input type="text" class="form-control col-8" name="job_id" placeholder="ID..." />
                                <button class="btn btn-primary col-4" type="submit">By Id</button>
                            </form>


                        </div>
                        <div class="col-md-6">
                            <form action="{{ url('manager/tuition_search_by_phone') }}" method="POST" class="row">
                                @csrf
                                <input type="text" class="form-control col-8" name="phone" placeholder="Phone...." />
                                <button class="btn btn-primary col-4" type="submit">By Phone</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Manager</th>
                                        <th>Note</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentProfile as $student)
                                        <tr>
                                            <td>
                                                {{ $student->id }}
                                            </td>
                                            <td>{{ $student->s_fullName }}
                                                @if ($student->partner)
                                                    <br>
                                                    <a
                                                        href="{{ url('manager/uddokta_details/' . $student->partner->id) }}">
                                                        <span
                                                            class="badge badge-pill badge-info">{{ $student->partner->name }}</span>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $student->s_phoneNumber }}</td>
                                            <td style="width: 140px">
                                                {{ $student->districts ? $student->districts->districtName : '' }},
                                                {{ $student->s_area }} , {{ $student->s_address }}</td>
                                            <td>{{ $student->manager_info ? $student->manager_info->name : '' }}</td>

                                            <td>
                                                <!--<i class="fa fa-check text-success"></i>-->
                                                <b>{{ $student->note }}</b>
                                            </td>
                                            <td>{{ $student->created_at->format('h:i A | d M,Y') }}</td>
                                            <td style="width:120px">
                                                @if ($student->approval == 4)
                                                    <span class="badge badge-pill badge-info">Pending</span>
                                                @elseif($student->approval == 5)
                                                    <span class="badge badge-pill badge-dark">Cancel</span>
                                                @else
                                                    @if ($student->confirmed)
                                                        <span class="badge badge-pill badge-success">Confirmed</span>
                                                    @elseif($student->assigned->count() > 0)
                                                        <span class="badge badge-pill badge-warning">Assigned</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td style="width: 80px">
                                                <a href="{{ url('manager/student_details') }}{{ $student->id }}"
                                                    class="btn btn-default btn-xs m-r-5" data-toggle="tooltip"
                                                    data-original-title="Details"><i
                                                        class="fa fa-info-circle font-14"></i></a>
                                                <a type="button" data-toggle="modal"
                                                    data-target="#editModalAssign{{ $student->id }}" data-toggle="tooltip"
                                                    data-original-title="Keep Note" title="Keep Note"
                                                    class="btn btn-default btn-xs"><i class="fa fa-edit font-14"></i></a>


                                                <div class="modal fade" id="editModalAssign{{ $student->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ url('manager/approval_student_list/note/' . $student->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <h5 for="text-danger">Add Important Note:</h5>
                                                                        <hr>

                                                                        <textarea placeholder="Enter note..." class="form-control" name="note" rows="5" required>{{ $student->note }}</textarea>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-lg btn-outline-primary px-4">Submit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>



                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <?php echo $studentProfile->links(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    $("select").click(function() {
    var open = $(this).data("isopen");
    if(open) {
    window.location.href = $(this).val()
    }
    //set isopen to opposite so next time when use clicked select box
    //it wont trigger this event
    $(this).data("isopen", !open);
    });
@endsection
