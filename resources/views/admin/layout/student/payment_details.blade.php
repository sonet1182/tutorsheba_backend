@extends('admin.master')

@section('title')
    ID# 01000{{ $studentDetails->id }} Tuition Details | Admin
@stop

@section('content')
    <div class="page-heading">
        <h1 class="page-title">ID# 01000{{ $studentDetails->id }} <strong>Student Information</strong></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/new_student_request') }}">New Student Request</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/approval_student_list') }}">Approval Student List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/rejected_situdent_list') }}">Rejected student List</a>
            </li>
        </ol>
    </div>


    @if (session('app'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{ session('app') }}.
        </div>
    @endif
    @if (session('rej'))
        <div class="alert alert-danger">
            <strong>Danger!</strong> {{ session('rej') }}.
        </div>
    @endif
    @if (\Session::has('status'))
        <div class="alert alert-success">
            {!! \Session::get('status') !!}
        </div>
    @endif

    <div class="page-content my-5">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">ID# 01000{{ $studentDetails->id }} <strong>Student Information</strong>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-uppercase">request time :</td>
                                    <td><b>{{ date('d M, Y', strtotime($studentDetails->created_at)) }} At
                                            {{ date('g:ia', strtotime($studentDetails->created_at)) }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Approval :</td>
                                    <td>{{ $studentDetails->approval }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Full Name :</td>
                                    <td>{{ $studentDetails->s_fullName }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Phone Number :</td>
                                    <td>{{ $studentDetails->s_phoneNumber }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">E-Mail :</td>
                                    <td>{{ $studentDetails->s_email }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Gender :</td>
                                    <td>{{ $studentDetails->s_gender }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">School/College : </td>
                                    <td>{{ $studentDetails->s_college }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Class : </td>
                                    <td>{{ $studentDetails->s_class }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Subject : </td>
                                    <td>{{ $studentDetails->t_subject }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Medium : </td>
                                    <td>{{ $studentDetails->s_medium }}</td>
                                </tr>
                                <tr>
                                    <td>Student Address : </td>
                                    <td>{{ $studentDetails->districtName }} , {{ $studentDetails->s_area }} ,
                                        {{ $studentDetails->s_address }}</td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase"><strong>Preferred Teacher :</strong> </td>
                                    <td>
                                        <h4>{{ $studentDetails->t_gender }}</h4>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <h3>Tuition Info : </h3>
                        <hr>
                        <div class="my-2">
                            <div class="row py-1">
                                <div class="col-md-3">
                                    <strong>Current Status for Tuition : </strong>
                                </div>
                                <div class="col-md-7 text-left" id="value">
                                    <strong>Available</strong>
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-md-3">
                                    <strong>Expected Minimum Salary:</strong>
                                </div>
                                <div class="col-md-7">
                                    <strong>{{ $studentDetails->t_salary }}</strong>
                                </div>
                            </div>

                            <div class="row py-1">
                                <div class="col-md-3">
                                    <strong>Days per week :</strong>
                                </div>
                                <div class="col-md-7">
                                    <strong>{{ $studentDetails->t_days }}</strong>
                                </div>
                            </div>

                            <div class="row py-1">
                                <div class="col-md-3">
                                    <strong>Preferred Subjects :</strong>
                                </div>
                                <div class="col-md-7">
                                    <strong>{{ $studentDetails->t_subject }}</strong>
                                </div>
                            </div>

                            <div class="row py-1">
                                <div class="col-3">
                                    <strong>Preferred Areas for tuition :</strong>
                                </div>
                                <div class="col-7">
                                    <strong class="text-success"> {{ $studentDetails->districtName }}</strong>
                                    <br>
                                    <h5>{{ $studentDetails->s_area }}</h5>
                                </div>
                            </div>

                            <div class="row py-1">
                                <div class="col-3">
                                    <strong>Extra Information :</strong>
                                </div>
                                <div class="col-7">

                                    <h5>{{ $studentDetails->ex_information }}</h5>
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="card-footer">

                        @if ($confirmed)
                            <h3>Cofirmed Teacher: </h3>
                            <hr>
                            <div class="card mb-3">
                                <div class="row">
                                    <div class="col-md-2 col-sm-5 col-xs-12 text-center">
                                        <a href="{{ url('/admin/teacher_details') }}{{ $confirmed->teacher->id }}">

                                            <img class="styleBorderImg"
                                                src="{{ asset($confirmed->teacher->teacher->teacher_profile_picture) }}"
                                                alt="{{ $confirmed->teacher->teacher->teacher_profile_picture }}"
                                                onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/teacher/icons/instagram-ui-twotone/48/Paul-18-512.png';" /></a>
                                        <br>
                                        <strong>ID # {{ $confirmed->teacher->teacher->teacher_id }} </strong>
                                    </div>
                                    <div class="col-md-4 col-sm-7 col-xs-12"> <strong><span class="text-info">
                                                {{ $confirmed->teacher ? $confirmed->teacher->name : '' }} </span></strong>
                                        <br>
                                        <span style="color: green;"> Member Since:
                                            {{ $confirmed->teacher->teacher->created_at->format('d-M-Y') }} </span>
                                        <br>
                                        <span>{{ $confirmed->teacher->teacher->tuition_salary }}</span> <br>
                                        <strong>Qualification:</strong> {{ $confirmed->teacher->teacher->teacher_degree }}
                                        <br>
                                        <strong>Honours Ins:</strong> {{ $confirmed->teacher->teacher->honours_institute }}
                                        <br>
                                        <strong>Tuition Me:</strong> {{ $confirmed->teacher->teacher->tuition_medium }}
                                        <br>
                                        <strong>Teaching:</strong> {{ $confirmed->teacher->teacher->tuition_subject }}
                                        <br><br>


                                    </div>
                                    <div class="col-md-4 space-htop">
                                        <span class="badge badge-pill badge-success badge-sm my-2 w-100">Confirmed</span>
                                        <strong>Assigned at:</strong>{{ $confirmed->created_at->format('h:i A | d-M-Y') }}
                                        <br>
                                        <strong>Assigned by:</strong>{{ $confirmed->confirmed_by }}<br>
                                        <strong>Remark:</strong>{{ $confirmed->remark }} <br>
                                        <hr>
                                        <strong>Fee:</strong>{{ $confirmed->fee }} <br>
                                        <strong>Advance:</strong>{{ $confirmed->advance }} <br>
                                    </div>
                                    <div class="col-md-2">

                                        <button type="button" class="btn btn-md btn-primary px-4 mt-2 w-100"
                                            data-toggle="modal" data-target="#editModal">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </button>


                                        <!-- Modal -->
                                        <div class="modal fade" id="editModal" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <form action="{{ url('admin/confirmed_teacher/edit/' . $confirmed->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="teacher_id"
                                                                value="{{ $confirmed->teacher->id }}" />
                                                            <input type="hidden" name="student_id"
                                                                value="{{ $studentDetails->id }}" />
                                                            <div class="form-group">
                                                                <h5 for="text-danger">Edit Confirmation Info:
                                                                </h5>
                                                                <hr>
                                                                <b>Matching Fee:</b>
                                                                <input type="number" name="fee" class="form-control my-2"
                                                                    placeholder="" value="{{ $confirmed->fee }}">
                                                                <b>Discount:</b>
                                                                <input type="number" name="discount" class="form-control my-2"
                                                                    placeholder="" value="{{ $confirmed->discount }}">
                                                                    <hr>
                                                                    <b>Enter Remark:</b>
                                                                <textarea placeholder="Remark..." class="form-control" name="remark" rows="5">{{ $confirmed->remark }}</textarea>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-lg btn-outline-primary px-4">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-12 ml-2 mb-1">
                                        <strong>Experience:</strong> {{ $confirmed->teacher->teacher->tuition_experience }}
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-md-center my-5">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('admin/payment_submit/' . $confirmed->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="teacher_id" value="{{ $confirmed->teacher->id }}" />
                            <input type="hidden" name="student_id" value="{{ $studentDetails->id }}" />
                            <div class="form-group">
                                <h4 for="text-danger text-center">Payment Statistics</h4>
                                <hr>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tuition Fee</th>
                                                <th>Matching Fee</th>
                                                <th>Discount</th>
                                                <th>Paid</th>
                                                <th>Due</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <th>{{ $studentDetails->t_salary }}</th>
                                            <th>{{ $confirmed->fee }}</th>
                                            <th>{{ $confirmed->discount }}</th>
                                            <th>{{ $confirmed->paid }}</th>
                                            <th>{{ $confirmed->due }}</th>
                                        </tbody>
                                    </table>
                                </div>

                                <b>Enter Payment Amount:</b>
                                <input type="number" name="payment" class="form-control my-2" placeholder="payment..."
                                    required="required">
                                    <b>Enter Remark:</b>
                                <textarea placeholder="Rremark..." class="form-control" name="remark" rows="5"></textarea>
                            </div>
                            <hr>

                            <button type="submit" class="btn btn-lg btn-outline-primary px-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">


                    <div class="card-body">
                        <h3 class="text-center">Tansactions</h3>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Payment</th>
                                        <th>Remark</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $txn)
                                        <tr>
                                            <td>{{ $txn->id }}</td>
                                            <td>{{ $txn->payment }}</td>
                                            <td>{{ $txn->remark }}</td>
                                            <td>{{ $txn->created_at->format('d M,Y | h:i A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>











    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

@endsection



@section('script')

    <script>
        $(document).on('click', '#btnSendData', function(event) {

            event.preventDefault();

            let text = "";

            var form = $('#create-form')[0];
            var formData = new FormData(form);
            // Set header if need any otherwise remove setup part
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
                }
            });
            $.ajax({
                url: "{{ route('admin.find_teacher') }}",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(res) {
                    $("#teacher_box").empty();
                    $("#teacher_box").append(res);
                },
                error: function(data) {
                    $.each(data.responseJSON.errors, function(key, value) {
                        ErrorMessage(key, value); // validation message show
                    });
                }
            });
        });
    </script>


@endsection
