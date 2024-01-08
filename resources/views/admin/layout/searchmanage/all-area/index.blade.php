@extends('admin.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Area</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/all-area') }}">Area List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/all-area/create') }}">Create Area</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">

                        <a href="{{ url('/admin/all-area/create') }}" class="btn btn-success btn-sm"
                            title="Add New AllArea">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a><br>

                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>District Name</th>
                                        <th>Area Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allarea as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                @if (isset($item->all_districts->districtName))
                                                    {{ $item->all_districts->districtName }}
                                                @else
                                                    {{ '----' }}
                                                @endif
                                            </td>
                                            <td>{{ $item->areaName }}</td>
                                            <td>

                                                <a href="{{ url('/admin/all-area/' . $item->id . '/edit') }}"
                                                    title="Edit Area"><button class="btn btn-primary btn-xs"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Edit</button></a>
                                                <a href="{{ url('/admin/all-area/' . $item->id . '/delete') }}"
                                                    title="Delete Area"><button class="btn btn-danger btn-xs"><i
                                                            class="fa fa-trash" aria-hidden="true"></i>
                                                        Delete</button></a>

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
