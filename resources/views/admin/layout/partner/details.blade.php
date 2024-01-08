@extends('admin.master')

@section('title', 'New Tuition Request | Admin')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Uddokta Details</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item active">Details</li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/uddokta_list') }}">Uddokta List</a></li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <div class="card mb-3">
                            <div class="row">
                                <div class="col-md-2 col-sm-5 col-xs-12 text-center">

                                    <img class="styleBorderImg" src="{{ asset($partner->profile_picture) }}"
                                        alt="{{ $partner->id }}"
                                        onerror="this.onerror=null;this.src='{{ asset('img/icon/user1.png') }}'" />

                                    <br>
                                    <strong>ID # {{ $partner->id }} </strong>
                                </div>
                                <div class="col-md-3 col-sm-7 col-xs-12"> <strong><span class="text-info">
                                            {{ $partner->name }}
                                        </span></strong> <br>
                                    <span style="color: green;"> Member Since:
                                        {{ $partner->created_at->format('d-M-Y') }} </span>
                                    <br>
                                    <strong>Phone:</strong> {{ $partner->phoneNumber }} <br>
                                    <strong>Email:</strong>
                                    {{ $partner->email }} <br>
                                    <strong>Gender:</strong>
                                    {{ $partner->gender }} <br>
                                    <strong>Address:</strong>
                                    {{ $partner->areas ? $partner->areas->areaName : '' }}
                                    {{ $partner->districts ? ', ' . $partner->districts->districtName : '' }}
                                    <br>
                                    <hr>
                                    <strong>Agent Type:</strong> {{ $partner->agent_type }} <br>
                                    <strong>Org. Name:</strong> {{ $partner->org_name }} <br>
                                    <strong>Org. Address:</strong> {{ $partner->org_address }} <br>

                                </div>
                                <div class="col-md-4 space-htop">
                                    <span class="badge badge-pill badge-info badge-sm my-2 w-100">Banking</span>
                                    <strong>Bank Type: </strong><span
                                        style="font-size: 20px">{{ $partner->bank_type }}</span> <br>
                                    <strong>Account Number: </strong><span
                                        style="font-size: 30px">{{ $partner->acc_number }}</span><br>


                                    <br>

                                    {{-- <a data-toggle="modal" data-target="#editModalAssign{{ $partner->id }}"
                                        class="btn btn-outline-danger btn-sm">Edit</a> --}}
                                </div>

                                <div class="col-md-3">
                                    <span class="badge badge-pill badge-warning badge-sm my-2 w-100">Payment</span>
                                    <strong>Total Withdraw:</strong> {{ $partner->withdraw }} <br>
                                    <strong>Total due:</strong> {{ $partner->due }} <br>
                                </div>


                                <div class="col-sm-12 ml-2 mb-1">
                                    <strong>Experience:</strong>
                                    {{ $partner->org_details }}
                                </div>
                            </div>
                        </div>

                        <h3 class="mt-4">Leads List: </h3>

                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif

                        <div class="table-responsive card p-3">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Tution Fee</th>
                                        <th>TSheba Comission</th>
                                        <th>Udddokta Comission</th>
                                        <th>Payment Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leads as $lead)
                                        <tr>
                                            <td>
                                                {{ $lead->id }}
                                            </td>
                                            <td>{{ $lead->title }}</td>
                                            <td>

                                                @if ($lead->confirmed)
                                                    <span class="badge badge-pill badge-success">Confirmed</span>
                                                @elseif($lead->assigned->count() > 0)
                                                    <span class="badge badge-pill badge-warning">Assigned</span>
                                                @elseif ($lead->approval == 0)
                                                    <span class="badge badge-pill badge-primary">New</span>
                                                @elseif ($lead->approval == 1)
                                                    <span class="badge badge-pill badge-info">Published</span>
                                                @elseif($lead->approval == 4)
                                                    <span class="badge badge-pill badge-secondary">Pending/Hold</span>
                                                @elseif($lead->approval == 5)
                                                    <span class="badge badge-pill badge-dark">Cancel</span>
                                                @elseif($lead->approval == 3)
                                                    <span class="badge badge-pill badge-danger">Rejected</span>
                                                @endif

                                            </td>
                                            <td>{{ $lead->t_salary }}</td>
                                            <td>{{ $lead->confirmed->fee ?? '' }}</td>
                                            <td>{{ $lead->lead_comission }}</td>
                                            <td>
                                                @if ($lead->lead_due > 0)
                                                    <span
                                                        class="badge badge-pill badge-danger badge-sm my-2 w-100">Due</span>
                                                @elseif ($lead->lead_comission > 0 && $lead->lead_due == 0)
                                                    <span
                                                        class="badge badge-pill badge-success badge-sm my-2 w-100">Paid</span>
                                                @endif
                                            </td>
                                            <td>

                                                @if ($lead->lead_due > 0)
                                                    <button type="button" class="btn btn-sm btn-primary mt-2"
                                                        data-toggle="modal" data-target="#exampleModal{{ $lead->id }}"
                                                        {{ $lead->t_salary <= 0 ? 'disabled' : '' }}>
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        Make Payment
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-primary mt-2" disabled>
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        Make Payment
                                                    </button>
                                                @endif





                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $lead->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <form class="text-center"
                                                                    action="{{ url('admin/uddokta/make_payment/' . $lead->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <h5 class="text-center">Are you sure to Make Payment
                                                                            for
                                                                            tuition id - <a
                                                                                href="{{ url('admin/student_details' . $lead->id) }}">{{ $lead->id }}
                                                                            </a>?</h5>
                                                                        <hr>

                                                                        <div class="text-center">
                                                                            <h4>
                                                                                <mall>Amount: </mall>
                                                                                {{ $lead->lead_comission }} Tk
                                                                            </h4>
                                                                        </div>

                                                                        <div class="text-center">
                                                                            @if ($partner->bank_type == 'Bkash')
                                                                                <img src="{{ asset('/img/icon/bkash-logo@logotyp.us.svg') }}"
                                                                                    alt="bkash" height="140px"
                                                                                    width="320px">
                                                                            @elseif($partner->bank_type == 'Nagad')
                                                                                <img src="{{ asset('/img/icon/nagad-logo@logotyp.us.svg') }}"
                                                                                    alt="bkash" height="140px"
                                                                                    width="320px">
                                                                            @elseif($partner->bank_type == 'Rocket')
                                                                                <h2>Rocket</h2>
                                                                            @endif
                                                                        </div>

                                                                        <h3 class="text-center"> <small>Acc Number: </small>
                                                                            {{ $partner->acc_number }}</h3>
                                                                    </div>

                                                                    <input type="hidden" name="bank_type"
                                                                        value="{{ $partner->bank_type }}" />
                                                                    <input type="hidden" name="acc_number"
                                                                        value="{{ $partner->acc_number }}" />


                                                                    <div class="float-right">
                                                                        <button type="submit"
                                                                            class="btn btn-lg btn-outline-danger px-4">Confirm</button>
                                                                    </div>
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

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
