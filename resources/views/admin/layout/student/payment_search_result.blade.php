@extends('admin.master')

@section('title','Approval Tuition | Admin')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Payment Sheet</h1>
        <!--<ol class="breadcrumb">-->
        <!--    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>-->
        <!--    <li class="breadcrumb-item"><a href="{{ url('/admin/new_student_request') }}">New Request</a></li>-->
        <!--    <li class="breadcrumb-item active">Approval</li>-->
        <!--    <li class="breadcrumb-item"><a href="{{ url('/admin/rejected_student_list') }}">Rejectet</a></li>-->
        <!--</ol>-->
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-md-4 ">

                                <form action="{{ url('admin/payment/tuition_search_by_id') }}" method="POST" class="row">
                                    @csrf
                                    <b>Search By Student Id:</b>
                                    <input type="text" class="form-control col-8" name="job_id" placeholder="ID..."/>
                                    <button class="btn btn-primary col-4" type="submit">By Id</button>
                                </form>


                        </div>
                        <div class="col-md-4">
                            <form action="{{ url('admin/payment/tuition_search_by_phone') }}" method="POST" class="row">
                                    @csrf
                                    <b>Search By Teacher Id:</b>
                                    <input type="text" class="form-control col-8" name="phone" placeholder="Phone...."/>
                                    <button class="btn btn-primary col-4" type="submit">By Phone</button>
                                </form>
                        </div>
                        <div class="col-md-4">
                                        <b>Search By Manager:</b>
                                        <select class="form-control col-12" name="manager" onchange="location = this.value;">
                                        <option value="{{ url('admin/payment/approval_student_list') }}">All</option>
                                        @foreach($manager_list as $managert)

                                            <option value="{{ url('admin/payment/approval_student_list/by_manager/'.$managert->id) }}" {{ $manager == $managert->id ? 'selected' : '' }} >{{ $managert->name }}</option>
                                        @endforeach
                                    </select>
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
                                    <th>Student Id</th>
                                    <th>Teacher Name</th>
                                    <th>Matching Fee</th>
                                    <th>Discount</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Time</th>
                                    <th>Remark</th>
                                    <th>Manager</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($confirmations as $con)
                                    <tr>
                                        <td>{{ $con->id }}</td>
                                        <td>{{ $con->student_id }}</td>
                                        <td>
                                            <small>{{ $con->teacher->name }}</small><br>
                                            <b>{{ $con->teacher->phoneNumber }}</b>
                                        </td>
                                        <td>{{ $con->fee }}</td>
                                        <td>{{ $con->discount }}</td>
                                        <td><b class="text-success">{{ $con->paid }}</b></td>
                                        <td>
                                            @if($con->due < 1)
                                                <b class="text-success">{{ $con->due }}</b>
                                            @else
                                                <b class="text-danger">{{ $con->due }}</b>
                                            @endif
                                        </td>
                                        <td>{{ $con->created_at->format('d/m/y') }}</td>
                                        <td>{{ $con->remark }}</td>
                                        <td>{{ $con->student->manager_info ? $con->student->manager_info->name : '' }}</td>
                                        <td>
                                            @if($con->fee <= $con->paid)
                                                <span class="badge badge-pill badge-success badge-sm">Paid</span>
                                            @elseif($con->paid != 0 && $con->fee > $con->paid)
                                                <span class="badge badge-pill badge-warning badge-sm">Partial</span>
                                            @elseif($con->paid == 0)
                                                <span class="badge badge-pill badge-danger badge-sm">Due</span>
                                            @endif
                                        </td>
                                        <td style="width: 80px">
                                            <a href="{{ url('admin/payment_details/'.$con->student_id) }}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Details"><i class="fa fa-edit font-14"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <?php echo $confirmations->links(); ?>
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
