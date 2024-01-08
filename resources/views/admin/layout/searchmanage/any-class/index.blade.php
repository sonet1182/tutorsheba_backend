@extends('admin.master')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Class List</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/any-class') }}">Class List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/any-class/create') }}">Create Class</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>



    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('/admin/any-class/create') }}" class="btn btn-success btn-sm"
                            title="Add New AnyClass">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    </div>
                    <div class="card-body">

                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{ session()->get('status') }}
                            </div>
                        @endif


                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Medium Name</th>
                                        <th>ClassName</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anyclass as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                @if (isset($item->all_media->mediumName))
                                                    {{ $item->all_media->mediumName }}
                                                @else
                                                    {{ '----' }}
                                                @endif
                                            </td>
                                            <td>{{ $item->className }}</td>
                                            <td>
                                                <a href="{{ url('/admin/any-class/' . $item->id . '/edit') }}"
                                                    title="Edit AnyClass"><button class="btn btn-primary btn-xs"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Edit</button></a>
                                                <a href="{{ url('/admin/any-class/' . $item->id . '/delete') }}"
                                                    title="Edit AnyClass"><button class="btn btn-danger btn-xs"><i
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
