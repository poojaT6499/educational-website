@extends('admin.inc.base')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit questionandanswer</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{Request::root()}}/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/questionandanswer">Question /
                        Answers</a></li>
                <li class="breadcrumb-item active"><a
                        href="{{Request::root()}}/admin/questionandanswer/add-questionandanswer">Add
                        Question / Answers</a>
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
                            action="{{Request::root()}}/admin/questionandanswer/edit-questionandanswer-post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" value="<?php echo $questionAnswer->questionAnswerID ?>"
                                name="questionAnswerID">
                            <div class="form-group">
                                <label for="questionID">Choose Question:</label>
                                <select name="questionID" id="questionID">
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="answerID">Choose Answer:</label>
                                <select name="answerID" id="answerID">
                                    <option value="1">1</option>
                                </select>
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