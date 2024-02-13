@extends('admin.inc.base')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit answer</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{Request::root()}}/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/answer">Answer</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/answer/add-answer">Add
                        Answer</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form role="form" method="post" action="{{Request::root()}}/admin/answer/edit-answer-post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" value="<?php echo $answer->answerID ?>" name="answerID">
                            <div class="form-group">
                                <label for="questionID">Choose Question :</label>
                                <select name="questionID" id="questionID">
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="questionType">Question Type:</label>
                                <input type="text" class="form-control" id="questionType" name="questionType"
                                    value="<?php echo $answer->questionType ?>">
                            </div>
                            <div class="form-group">
                                <label for="answerList">Answer List:</label>
                                <input type="text" class="form-control" id="answerList" name="answerList"
                                    value="<?php echo $answer->answerList ?>">
                            </div>
                            <div class="form-group">
                                <label for="correctAnswer">Correct Answer :</label>
                                <input type="text" class="form-control" id="correctAnswer" name="correctAnswer"
                                    value="<?php echo $answer->correctAnswer?>">
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