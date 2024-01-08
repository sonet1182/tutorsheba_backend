@extends('admin.master')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Matching Teacher List</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Matching Teacher List</li>
            </ol>
        </nav>
    </div>

    <form action="{{ url('admin/send_bulk_text') }}" method="post">
         @csrf

    <div class="row">
        <div class="col-12">
            <div class="ibox">
                <div class="ibox-body table-responsive">
                    <h4><input type="checkbox" name="select_option" style="height: 20px; width: 20px" id="select_option" onclick="checkedAll.call(this);">&nbsp;Select/Unsellect All</h4>
                    <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                  Send Message
                                </button>
                </div>
            </div>
        </div>
    </div>

    @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('message') }}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">



                                          <div class="form-group">
                                            <h5 for="exampleInputEmail1">Enter Message Here...</h5>
                                            <hr>
                                            <textarea placeholder="" class="form-control" name="message" rows="5"></textarea>
                                          </div>
                                          <button type="submit" class="btn btn-lg btn-outline-primary px-4">Submit</button>

                                      </div>
                                    </div>
                                  </div>
                                </div>


    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-12">
                <div class="ibox">
                    <div class="ibox-body table-responsive">
                        <table class="table table-bordered" id="dataTable2">
                            <thead>
                            <tr>
                                <th>Select</th>
                                <th>Teacher ID#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Profile Verification</th>
                                <th>Time</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teacher as $value)
                                <tr>
                                    <td>
                                         <input class="text-center" type="checkbox" name="all_option[]" value="{{ $value->user ? $value->user->phoneNumber : '' }}">
                                    </td>
                                    <td>{{ $value->user_id }}</td>
                                    <td>
                                        <img class="styleBorderImg" src="{{ asset($value->teacher_profile_picture) }}" alt="" height="60px" width="60px"
                            onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/data/icons/instagram-ui-twotone/48/Paul-18-512.png';"/>
                                    </td>
                                    <td>{{ $value->user ? $value->user->name : '' }}</td>
                                    <td>{{ $value->user ? $value->user->phoneNumber : '' }}</td>
                                    <td>
                                        @if($value->user &&  $value->user->approval == 1)
                                            <span class="badge badge-pill badge-success">success</span>
                                        @else
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->created_at->format('h:i:s || d-M-Y') }}</td>
                                    <td>
                                        <a href="{{ url('/admin/teacher_details'.$value->user_id) }}" title="View" class="btn btn-info btn-xs px-2"><i class="fa fa-eye" aria-hidden="true"></i></a>

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

    </form>

    <script>
        function checkedAll() {

        var elements = document.querySelectorAll('input[type="checkbox"]');
            for (var i = elements.length; i--; ) {
                if (elements[i].type == 'checkbox') {
                    elements[i].checked = this.checked;
                }
            }
    }
    </script>
@endsection
