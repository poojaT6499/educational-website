@extends('layouts.teacher.app')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>All Notifications</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('teacher.notification') }}">Notifications</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Notifications</h4>
                    <a href="{{ route('teacher.notification.create') }}" class="btn btn-primary">Create Notification</a>
                </div>
                <div class="card-body">
                    {{-- <div class="form-row">
                        <div class="form-group col-md-4">
                            <span class="text-muted">Class Name: </span> <p class="d-inline">{{ $class->name }}</p>
                        </div>
                        <div class="form-group col-md-4">
                            <span class="text-muted">Subject Name: </span> <p class="d-inline">{{ $subject->name }}</p>
                        </div>
                    </div>
                    <hr> --}}
                    {{-- @if(Session::has('message'))
                    <div class="alert alert-success">
                        <strong><span class="glyphicon glyphicon-ok"></span>{{ Session::get('message') }}</strong>
                    </div>
                    @endif --}}
                    <div class="table-responsive">
                        @if(count($notifications)>0)
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Class</th>
                                    <th>Message</th>
                                    <th>Date & Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach($notifications as $notification)
                                <tr>
                                    <td>{{ $i++ }} </td>
                                    <td>
                                        <?php
                                            foreach ($classes as $class) {
                                                if ($class->id == $notification->classes_id) {
                                        ?>
                                                    {{ $class->name }}
                                        <?php
                                                }
                                            }
                                        ?>

                                    </td>
                                    <td>
                                        {{ $notification->message }}
                                    </td>
                                    <td>{{ date('d M, Y H:i A', strtotime($notification->created_at)); }}</td>
                                    <td>
                                        <a href="{{ route('teacher.notification.delete', $notification) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="alert alert-info" role="alert">
                            <strong>No Data Found!</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
