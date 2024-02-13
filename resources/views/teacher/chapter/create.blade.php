@extends('layouts.teacher.app')

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
                <li class="breadcrumb-item"><a href="{{ route('teacher') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="">Chapters</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('teacher.chapter.create', [$class->id, $subject->id]) }}">Add Chapter</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <div class="mb-3">
                            <h4>Details</h4>
                        </div>
                        <form role="form" method="POST" action="{{ route('teacher.chapter.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" value="{{ $class->id }}" name="class_id" hidden>
                        <input type="text" value="{{ $subject->id }}" name="subject_id" hidden>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <span class="text-muted">Class Name: </span> <p class="d-inline">{{ $class->name }}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <span class="text-muted">Subject Name: </span> <p class="d-inline">{{ $subject->name }}</p>
                            </div>
                            <div class="form-group col-md-4">
                                {{-- <span class="text-muted">Email: </span> <p class="d-inline">{{ $teacher->email }}</p> --}}
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <h4>Chapter Info</h4>
                        </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Chapter Name:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h4>Video Details</h4>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="media_title">Video Title:</label>
                                    <input type="text" class="form-control" id="media_title" name="media_title">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="video">Upload Video:</label>
                                    <input type="file" class="form-control" id="video" name="video">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_demo">Is It Demo Video </label>
                                <input type="checkbox" name="is_demo">
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h4>Attach Notes/Assignments</h4>
                            </div>
                            <div class="form-group">
                                <label for="notes">Files:</label>
                                <input type="file" class="form-control" id="notes" name="notes[]" multiple>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
