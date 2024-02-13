@extends('admin.inc.base')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit Media</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{Request::root()}}/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/Media">media</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/Media/add-Media">Add
                        Media</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form role="form" method="post" action="{{Request::root()}}/admin/Media/edit-Media-post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" value="<?php echo $media->MediaID ?>" name="MediaID">
                            <div class="form-group">
                                <label for="ChapterID">Choose Chapter :</label>
                                <select name="ChapterID" id="ChapterID" required>
                                    @foreach ($chapterData as $item)
                                    <option value="{{ $item->ChapterID }}">{{ $item->ChapterID }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="MediaType">Media Type:</label>
                                <input type="text" class="form-control" id="MediaType" name="MediaType"
                                    value="<?php echo $media->MediaType ?>">
                            </div>
                            <div class="form-group">
                                <label for="MediaUrl">Media Url:</label>
                                <input type="text" class="form-control" id="MediaUrl" name="MediaUrl"
                                    value="<?php echo $media->MediaUrl ?>">
                            </div>
                            <div class="form-group">
                                <label for="MediaTitle">Media Title:</label>
                                <input type="text" class="form-control" id="MediaTitle" name="MediaTitle"
                                    value="<?php echo $media->MediaTitle?>">
                            </div>
                            <div class="form-group">
                                <label for="MediaSubTitle">Media SubTitle:</label>
                                <input type="text" class="form-control" id="MediaSubTitle" name="MediaSubTitle"
                                    value="<?php echo $media->MediaSubTitle?>">
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