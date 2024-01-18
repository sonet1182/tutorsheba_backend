@extends('admin.master')
@section('title', 'Logout Managing | TutorSheba')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Logged in User Managing</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
        </ol>
    </div>
    <div class="page-content fade-in-up">

        @if (session('message'))
            <div class="alert alert-success text-center">
                <h4>{{ session('message') }}</h4>
            </div>
        @endif

        <div class="card container">
            <div class="card-header">
                <h4 class="text-center">Admin List</h4>
                <div class="row">
                    <a href={{ url('/admin/logout-all-admins') }} type="button" style="margin-left: auto"
                        class="btn btn-sm btn-outline-danger px-3"><i class="fa fa-sign-out  font-14"></i> Logout All
                        Admins</a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Last Sign in</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ date('d M, Y', strtotime($item->last_sign_in_at)) }} At
                                        {{ date('g:ia', strtotime($item->last_sign_in_at)) }}</td>

                                    <td class="text-center">
                                        <a type="button" href="{{ url('/admin/logout-admin/' . $item->id) }}"
                                            class="btn btn-xs btn-danger delete_barcode_button"><i
                                                class="fa fa-sign-out  font-14"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="card container mt-5">
            <div class="card-header">
                <h4 class="text-center">Manager List</h4>
                <div class="row">
                    <a href={{ url('/admin/logout-all-managers') }} type="button" style="margin-left: auto"
                        class="btn btn-sm btn-outline-danger px-3"><i class="fa fa-sign-out  font-14"></i> Logout All
                        Managers</a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Last Sign in</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($managers as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ date('d M, Y', strtotime($item->last_sign_in_at)) }} At
                                        {{ date('g:ia', strtotime($item->last_sign_in_at)) }}</td>

                                    <td class="text-center">
                                        <a type="button" href="{{ url('/admin/logout-manager/' . $item->id) }}"
                                            class="btn btn-xs btn-danger delete_barcode_button"><i
                                                class="fa fa-sign-out  font-14"></i></a>
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
