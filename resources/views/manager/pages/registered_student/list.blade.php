@extends('manager.layouts.master')

@section('title', 'Registered Student List | Manager')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Registered Student List</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Account Created</th>
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
                                            {{ \Carbon\Carbon::parse($student->created_at)->format('h:i a \| d M, Y') }}
                                            </td>
                                            <td>
                                                {{-- <a href="{{ url('admin/student_details') }}{{ $student->id }}"
                                                    class="btn btn-default btn-xs m-r-5" data-toggle="tooltip"
                                                    data-original-title="Details"><i class="fa fa-edit font-14"></i></a>
                                                <button class="btn btn-default btn-xs" data-toggle="tooltip"
                                                    data-original-title="Delete"><i
                                                        class="fa fa-trash font-14"></i></button> --}}

                                                <a class="badge badge-success" href="{{ url('manager/registered-student/details/'.$student->id) }}">
                                                 View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <?php echo $studentProfile->links(); ?> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
