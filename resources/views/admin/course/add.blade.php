@extends('admin.inc.base')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Add Course</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{Request::root()}}/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/Course">Course</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/Course/add-Course">Add
                        Course</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form role="form" method="post" action="{{Request::root()}}/admin/Course/add-Course-post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="ClassID">Choose Class :</label>
                                <select name="ClassID" id="ClassID">
                                    <option value="">Choose Clasess</option>
                                    @foreach ($classData as $item)
                                    <option value="{{ $item->ClassID }}">{{ $item->ClassTitle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="CourseTitle">Course Title:</label>
                                <input type="text" class="form-control" id="CourseTitle" name="CourseTitle">
                            </div>
                            <div class="form-group">
                                <label for="ChapterNos">Chapter Nos:</label>
                                <input type="text" class="form-control" id="ChapterNos" name="ChapterNos">
                            </div>
                            <div class="form-group">
                                <label for="TotalTime">Total Time:</label>
                                <input type="text" class="form-control" id="TotalTime" name="TotalTime">
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