@extends('admin.inc.base')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Add Question</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{Request::root()}}/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/question">Question</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/question/add-question">Add
                        Question</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form role="form" method="post" action="{{Request::root()}}/admin/question/add-question-post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="chapterID">Choose Chapter:</label>
                                <select name="chapterID" id="chapterID">
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="orderID">Choose Order:</label>
                                <select name="orderID" id="orderID">
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="courseID">Choose Course:</label>
                                <select name="courseID" id="courseID">
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="questionTitle">Question Title:</label>
                                <input type="text" class="form-control" id="questionTitle" name="questionTitle">
                            </div>
                            <div class="form-group">
                                <label for="questionType">Question Type:</label>
                                <input type="text" class="form-control" id="questionType" name="questionType">
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