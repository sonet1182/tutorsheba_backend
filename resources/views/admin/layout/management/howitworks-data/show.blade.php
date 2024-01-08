@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">HOW IT WORKS</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/howitworks-data') }}">How It Works List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/howitworks-data/create') }}">Create How It Works</a></li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">HOW IT WORKS {{ $howitworks_data->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/howitworks-data') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/howitworks-data/' . $howitworks_data->id . '/edit') }}" title="Edit How It Works"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/howitworks-data', $howitworks_data->id],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'title' => 'Delete How It Works',
                                'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $howitworks_data->id }}</td>
                                </tr>
                                <tr>
                                    <th>How It Works Title</th><td>{{ $howitworks_data->howitworks_title }}</td>
                                </tr>
                                <tr><th> How It Works Content </th><td> <?php echo htmlspecialchars_decode( $howitworks_data->howitworks_content ); ?> </td></tr>
                                <tr><th> How It Works Type </th><td> {{ $howitworks_data->howitworks_type }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection





