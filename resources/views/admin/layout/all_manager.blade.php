@extends('admin.master')
@section('title', 'All user List | TutorSheba')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Manager List</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.all_manager') }}">Enabled Manager</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.deleted_manager') }}">Disabled Manager List</a></li>
        </ol>

    </div>
    <div class="page-content fade-in-up">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Manager List</h3>
                <div class="row">
                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                        class="btn btn-sm btn-success px-3">Add Manager</button>
                    <a href={{ route('admin.deleted_manager') }} type="button" style="margin-left: auto"
                        class="btn btn-sm btn-outline-danger px-3">Disabled Manager List</a>
                </div>

            </div>


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="{{ url('admin/add_manager') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <h5 for="exampleInputEmail1">Enter Name:</h5>
                                    <hr>
                                    <input type="text" class="form-control" name="name" required/>
                                </div>
                                <div class="form-group">
                                    <h5 for="exampleInputEmail1">Enter Email:</h5>
                                    <hr>
                                    <input type="email" class="form-control" name="email" required/>
                                </div>
                                <div class="form-group">
                                    <h5 for="exampleInputEmail1">Enter Password:</h5>
                                    <hr>
                                    <input type="password" class="form-control" name="password" required/>
                                </div>
                                <button type="submit" class="btn btn-lg btn-outline-primary px-4">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>






            @if (session('message'))
                <div class="alert alert-success text-center">
                    <h4>{{ session('message') }}</h4>
                </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>E-Mail</th>
                                <th>Posted On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($managers as $tutors)
                                <tr>
                                    <td>
                                        {{ $tutors->id }}
                                    </td>
                                    <td>{{ $tutors->name }}</td>
                                    <td>{{ $tutors->phoneNumber }}</td>
                                    <td>{{ $tutors->email }}</td>
                                    <td>{{ date('d M, Y', strtotime($tutors->created_at)) }} At
                                        {{ date('g:ia', strtotime($tutors->created_at)) }}</td>

                                    <td>
                                        <button data-toggle="modal" data-target="#exampleModal{{ $tutors->id }}"
                                            class="btn btn-default btn-xs m-r-5"><i
                                                class="fa fa-pencil font-14"></i></button>
                                        <button type="button"
                                            data-href="{{ url('/admin/delete_manager/' . $tutors->id) }}"
                                            class="btn btn-xs btn-danger delete_barcode_button"><i
                                                class="fa fa-trash font-14"></i></button>

                                        <div class="modal fade" id="exampleModal{{ $tutors->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <form action="{{ url('admin/edit_manager/' . $tutors->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('POST')

                                                            <div class="form-group">
                                                                <h5 for="exampleInputEmail1">Enter Name:</h5>
                                                                <hr>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $tutors->name }}" required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <h5 for="exampleInputEmail1">Enter Email:</h5>
                                                                <hr>
                                                                <input type="email" class="form-control" name="email" value="{{ $tutors->email }}"  required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <h5 for="exampleInputEmail1">Enter Password:</h5>
                                                                <hr>
                                                                <input type="password" class="form-control" name="password"
                                                                    value="" required/>
                                                            </div>
                                                            <button
                                                                class="btn btn-lg btn-outline-primary px-4">Submit</button>
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
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('click', 'button.delete_barcode_button', function() {
            if (confirm("Are you sure you want to disable this Manager?")) {
                var href = $(this).data('href');
                $.ajax({
                    method: "GET",
                    url: href,
                    success: function(result) {
                        location.reload();
                        // alert(result.msg);
                        alert('Deleted Successfully!');
                    }
                });
            } else {
                return false;
            }
        });
    </script>
@endsection
