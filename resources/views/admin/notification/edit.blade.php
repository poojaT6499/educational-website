@extends('admin.inc.base')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit notification</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{Request::root()}}/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/notification">notification</a>
                </li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/notification/add-notification">Add
                        Notification</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form role="form" method="post"
                            action="{{Request::root()}}/admin/notification/edit-notification-post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" value="<?php echo $notification->notificationID ?>"
                                name="notificationID">
                            <div class="form-group">
                                <label for="notificationTitle"> NotificationTitle:</label>
                                <input type="text" class="form-control" id="notificationTitle" name="notificationTitle"
                                    value="<?php echo $notification->notificationTitle ?>">
                            </div>
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" class="form-control" id="date" name="date"
                                    value="<?php echo $notification->date ?>">
                            </div>
                            <div class="form-group">
                                <label for="time">Time:</label>
                                <input type="time" class="form-control" id="time" name="time"
                                    value="<?php echo $notification->time ?>">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection