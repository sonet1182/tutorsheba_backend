@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">HOW IT WORKS</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/howitworks-data') }}">How It Works List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/howitworks-data/create') }}">Create How It Works</a></li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">HOW IT WORKS DATA</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/howitworks-data/create') }}" class="btn btn-success btn-sm" title="Add New How It Works">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable">
                                <thead>
                                <tr>
                                    <th>SL</th><th>How It Works Title</th><th>How It Works Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; ?>
                                @foreach($howitworks_data as $item)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->howitworks_title }}</td>
                                        <td>{{ $item->howitworks_type }}</td>
                                        <td>
                                            <a href="{{ url('/admin/howitworks-data/' . $item->id) }}" title="View How It Works"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/howitworks-data/' . $item->id . '/edit') }}" title="Edit How It Works"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/howitworks-data', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete HOW IT WORKS',
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





