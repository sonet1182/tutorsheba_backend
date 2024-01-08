@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">FAQ</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/faq-data') }}">Faq List</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/faq-data/create') }}">Create Faq</a></li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">FAQ DATA</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/faq-data/create') }}" class="btn btn-success btn-sm" title="Add New FAQ">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable">
                                <thead>
                                <tr>
                                    <th>SL</th><th>FAQ Title</th><th>FAQ Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; ?>
                                @foreach($faq_data as $item)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->faq_title }}</td>
                                        <td>{{ $item->faq_type }}</td>
                                        <td>
                                            <a href="{{ url('/admin/faq-data/' . $item->id) }}" title="View FAQ"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/faq-data/' . $item->id . '/edit') }}" title="Edit FAQ"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/faq-data', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete FAQ',
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





