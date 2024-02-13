@extends('admin.inc.base')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Add livemeetings</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{Request::root()}}/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/livemeetings">livemeetings</a>
                </li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/livemeetings/add-livemeetings">Add
                        livemeetings</a>
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
                            action="{{Request::root()}}/admin/livemeetings/add-livemeetings-post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="classID">Choose Class:</label>
                                <select name="classID" id="classID">
                                    @foreach ($classData as $item)
                                    <option value="{{ $item->ClassID }}">{{ $item->ClassTitle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="courseID">Choose Course:</label>
                                <select name="courseID" id="courseID">
                                    @foreach ($courseData as $itemm)
                                    <option value="{{ $itemm->CourseID }}">{{ $itemm->CourseTitle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="time">Time:</label>
                                <input type="time" class="form-control" id="time" name="time">
                            </div>
                            <div class="form-group">
                                <label for="meetingUrl">livemeetings Url:</label>
                                <input type="text" class="form-control" id="meetingUrl" name="meetingUrl">
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