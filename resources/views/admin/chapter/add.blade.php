@extends('admin.inc.base')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Add Chapter</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{Request::root()}}/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/Chapter">Chapter</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/Chapter/add-Chapter">Add
                        Chapter</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form role="form" method="post" action="{{Request::root()}}/admin/Chapter/add-Chapter-post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="CourseID">Course:</label>
                                <option value="">Nothing Selected</option>
                                <select name="CourseID">
                                    @foreach ($courseData as $item)
                                    <option value="{{ $item->CourseID }}">{{ $item->CourseTitle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="VideoUrl">VideoUrl:</label>
                                <input type="text" class="form-control" id="VideoUrl" name="VideoUrl">
                            </div>
                            <div class="form-group">
                                <label for="IsLiveSession">IsLiveSession:</label>

                                <input type="hidden" name="IsLiveSession" value="0">
                                <input type="checkbox" name="IsLiveSession" value="1">
                            </div>
                            <div class="form-group">
                                <label for="OrderNo">OrderNo:</label>
                                <input type="text" name="OrderNo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Assignments">Files / Assignments:</label>
                                <input type="file" class="form-control" id="Assignments" name="Assignments">
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