@extends('manager.layouts.master')

@section('title','Individual Message | Admin')

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Individual Message List</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/manager/dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <!--<li class="breadcrumb-item"><a href="{{ url('/manager/new_student_request') }}">New Request</a></li>-->
            <!--<li class="breadcrumb-item active">Approval</li>-->
            <!--<li class="breadcrumb-item"><a href="{{ url('/manager/rejected_student_list') }}">Rejected</a></li>-->
        </ol>
    </div>

    <!--<div class="page-content fade-in-up">-->
    <!--    <div class="row justify-content-md-center">-->
    <!--        <div class="col-md-12">-->
    <!--            <div class="card">-->
    <!--                <div class="card-body row">-->
    <!--                    <div class="col-md-4 ">-->
    <!--                            <form action="{{ url('manager/tuition_search_by_id') }}" method="POST" class="row">-->
    <!--                                @csrf-->
    <!--                                <input type="text" class="form-control col-8" name="job_id" placeholder="ID..."/>-->
    <!--                                <button class="btn btn-primary col-4" type="submit">By Id</button>-->
    <!--                            </form>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->


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
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($texts as $text)
                                    <tr>
                                        <td>{{ $text->id }}</td>
                                        <td>{{ $text->user->name ?? '' }}</td>
                                        <td>{{ $text->user->phoneNumber ?? '' }}</td>
                                        <td>{{ $text->message }}</td>
                                        <td>{{ $text->created_at->format('H:i A | d M,Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <?php echo $texts->links(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

