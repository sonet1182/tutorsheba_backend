@extends('admin.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">All Districts</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/new_student_request') }}">New Student Request</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/approval_student_list') }}">Approval Student List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/rejected_student_list') }}">Rejected student List</a></li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4">
                                <a href="{{ url('/admin/all-districts/create') }}" class="btn btn-success btn-sm" title="Add New AllDistrict">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </a>
                            </div>
                            <div class="col-4">
                                <h3 class="text-center">All Districts List</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                <tr>
                                    <th>ID</th><th>DistrictName</th><th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teacherProfile as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ url('/admin/all-districts/' . $item->id) }}" title="View AllDistrict"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/all-districts/' . $item->id . '/edit') }}" title="Edit AllDistrict"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/all-districts', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete AllDistrict',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                            {!! Form::close() !!}
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




