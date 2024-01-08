@extends('admin.master')

@section('title', 'New Tuition Request | Admin')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Uddokta List</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item active">Uddokta List</li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        @if (session()->has('status'))
                            <div class="alert alert-success" id="status-alert">
                                {{ session()->get('status') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentProfile as $student)
                                        <tr>
                                            <td>
                                                {{ $student->id }}
                                            </td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->phoneNumber }}</td>
                                            <td>
                                                {{ $student->areas ? $student->areas->areaName : '' }}
                                                {{ $student->districts ? ', ' . $student->districts->districtName : '' }}
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="status"
                                                        {{ $student->status == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="validationCustom02"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/uddokta_details/' . $student->id) }}"
                                                    class="btn btn-default btn-xs m-r-5" data-toggle="tooltip"
                                                    data-original-title="Details"><i class="fa fa-edit font-14"></i></a>

                                                @if ($student->status == 1)
                                                    <a href="{{ url('admin/uddokta_status/' . $student->id) }}"
                                                        class="btn btn-xs btn-danger m-r-5" data-toggle="tooltip"
                                                        data-original-title="Details">Deactivate</a>
                                                @elseif($student->status == 0)
                                                    <a href="{{ url('admin/uddokta_status/' . $student->id) }}"
                                                        class="btn btn-xs btn-success m-r-5 px-3" data-toggle="tooltip"
                                                        data-original-title="Details">Activate</a>
                                                @endif


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
