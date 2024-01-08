@extends('admin.master')

@section('title', 'Approval Tuition | Admin')

@section('content')

    <div class="page-heading row">
        <h5 class="page-title col-md-3">
            Transactions<small>
                @if ($manager_name)
                    ({{ $manager_name }})
                @else
                    (Total)
                @endif
            </small>
        </h5>

        <div class="page-content fade-in-up col-md-9">
            <div class="card justify-content-md-center">
                <div class="row p-2">
                    <div class="col-md-3">Total Collection: <b class="text-primary">{{ number_format($total) }} Tk</b></div>
                </div>
            </div>
        </div>
    </div>



    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">


            @if (\Session::has('status'))
                <div class="col-md-12">
                    <div class="card">
                        <div class="alert alert-success text-center">
                            {!! \Session::get('status') !!}
                        </div>
                    </div>
                </div>
            @endif


            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <form class="row" action="" method="GET" class="row">

                            <div class="col-md-3">
                                <b>From:</b>
                                <input type="date" class="form-control" name="from"
                                    value="{{ request()->has('from') && request()->from != '' ? date('Y-m-d', strtotime(request()->from)) : '' }}" />
                            </div>
                            <div class="col-md-3">
                                <h6>To:</h6>
                                <input type="date" class="form-control" name="to"
                                    value="{{ request()->has('to') && request()->to != '' ? date('Y-m-d', strtotime(request()->to)) : '' }}" />
                            </div>
                            <div class="col-md-3">
                                <b>Search By Manager:</b>
                                <select class="form-control col-12" name="manager">
                                    <option value="0">All</option>
                                    @foreach ($manager_list as $item)
                                        <option value="{{ $item->id }}" @selected(request()->manager == $item->id)>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <br>
                                <button class="btn btn-primary w-100" type="submit">Search</button>
                            </div>
                            <div class="col-md-1">
                                <br>
                                <a href="{{ route('admin.transactions') }}" class="btn btn-danger w-100">Clear</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="page-content fade-in-up">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Student Id</th>
                                        <th>Student</th>
                                        <th>Teacher Name</th>
                                        <th>Teacher Phone</th>
                                        <th>Payment</th>
                                        <th>Remark</th>
                                        <th>Time</th>
                                        <th>Manager</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $txn)
                                        <tr>
                                            <td>{{ $txn->id }}</td>
                                            <td>{{ $txn->transaction->student->id ?? '' }}</td>
                                            <td>
                                                <a
                                                    href="{{ url('admin/payment_details/' . $txn->transaction->student->id) }}">
                                                    {{ $txn->transaction->student->title ?? '' }}
                                                </a>
                                            </td>
                                            <td>{{ $txn->teacher ? $txn->teacher->name : '' }}</td>
                                            <td>{{ $txn->teacher ? $txn->teacher->phoneNumber : '' }}</td>
                                            <td>{{ $txn->payment }}</td>
                                            <td>{{ $txn->remark }}</td>
                                            <td>{{ $txn->created_at->format('h:i A | d M,Y') }}</td>
                                            <td>{{ $txn->transaction->student->manager_info ? $txn->transaction->student->manager_info->name : '' }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-default btn-xs m-r-5"
                                                    data-toggle="modal" data-target="#editModal{{ $txn->id }}">
                                                    <i class="fa fa-edit"></i>
                                                    Edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal{{ $txn->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ url('admin/transactions/edit/' . $txn->id) }}"
                                                                    method="post">
                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <h5 for="text-danger">Edit Transaction Info:
                                                                        </h5>
                                                                        <hr>
                                                                        <b>Payment:</b>
                                                                        <input type="number" name="payment"
                                                                            class="form-control my-2" placeholder=""
                                                                            value="{{ $txn->payment }}">
                                                                        <b>Remark:</b>

                                                                        <textarea name="remark" class="form-control my-2">{{ $txn->remark }}</textarea>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-lg btn-outline-primary px-4">Update</button>
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

                            {{-- {{ $transactions->links() }} --}}
                            {{ $transactions->withQueryString()->links() }}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
