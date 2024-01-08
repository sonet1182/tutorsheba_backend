@extends('admin.master')

@section('content')
    <div class="content-wrapper">
        <!-- Page header -->
        <div class="page-header">
            <div class="breadcrumb-line">
                <ul class="breadcrumb">
                    <li><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li class="active">Member Ship</li>
                    <li><a href="{{ url('/admin/membership/create') }}">Member Ship create</a></li>
                </ul>

                <ul class="breadcrumb-elements">
                    <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-gear position-left"></i>
                            Settings
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                            <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                            <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content">



            <!-- Dashboard content -->
            <div class="body">
                <div class="row">
                    <h4 class="text-center">Premium membersip approved</h4>
                </div>
                @if (session('message'))
                    <div class="alert alert-success">
                        <span>{{ session('message') }}</span>
                    </div>
                @endif
                {!! Form::open(['url' => '/admin/sms','method'=>'POST', 'class'=>'row']) !!}

                <div class="form-group col-md-6">
                    <label for="email">Message:</label>
                    <textarea rows="11" class="form-control" name="message"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="pwd">Number:</label>
                    <select class="form-control" id="number-select">
                        @foreach($user as $users)
                        <option value="{{ $users->phoneNumber }}">{{ $users->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row  space-htop">
                    <div class="col-md-offset-5">
                        <button type="submit" class="btn btn-lg btn-success"> <strong>Send Message</strong> </button>
                    </div>
                </div>
                {!!  FORM::close() !!}
            </div>
        </div>
        <!-- /dashboard content -->

    </div>
    <!-- /content area -->
    </div>
@endsection
@section('script')
    {{ HTML::style('plugins/select2/select2.min.css') }}
    {{ HTML::script('plugins/select2/select2.min.js') }}
    <script type="text/javascript">
        $("select#number-select").select2();
    </script>
    @endsection
