@extends('admin.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Salary Range</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/salary-range') }}">Salary Range List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/salary-range/create') }}">Create salary range</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <a href="{{ url('/admin/salary-range/create') }}" class="btn btn-success btn-sm"
                            title="Add New salaryRange">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>SalaryRange</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salaryrange as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->salaryRange }} Tk/Month</td>
                                            <td>
                                                <a href="{{ url('/admin/salary-range/' . $item->id . '/edit') }}"
                                                    title="Edit salaryRange"><button class="btn btn-primary btn-xs"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Edit</button></a>
                                                <a href="{{ url('/admin/salary-range/' . $item->id . '/delete') }}"
                                                    title="Delete salaryRange"><button class="btn btn-danger btn-xs"><i
                                                            class="fa fa-trash" aria-hidden="true"></i> Delete</button></a>
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
