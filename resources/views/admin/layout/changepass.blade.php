@extends('admin.master')

@section('title')
    | Admin
    @stop

@section('content')
    <div class="page-heading">
        <h1 class="page-title"></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/all_user') }}">User List</a></li>
        </ol>

    </div>

    <div class="page-content my-5">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-sm btn-warning" href="{{ url('/admin/all_user') }}"><i class="fa fa-arrow-left"></i> back</a>
                        <h3 class="text-center"></h3>
                    </div>
                    <div class="card-body">
                       @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif


                    <form class="form-horizontal" action="{{route('admin.password.request',Auth::user()->id)}}" method="post">
                                            @csrf()



                                            <div class="form-group">
                                                <label for="OldPassword" class="col-sm-3 control-label">Change Email</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="email" class="form-control" id="email" name="email" value={{Auth::user()->email}} required="">
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="form-group">
                                                <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="Old Password" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="New Password" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPasswordConfirm" name="NewPassword_confirmation" placeholder="New Password (Confirm)" required="">
                                                    </div>
                                                </div>

                                                @if($errors->has('NewPassword'))
                                  <strong style="color:red">{{$errors->first('NewPassword')}}</strong>

                                  @endif
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-danger">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>





                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
