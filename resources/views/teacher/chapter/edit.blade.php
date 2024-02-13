@extends('layouts.teacher.app')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit Chapter</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="">Chapters</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('teacher.chapter.edit', [$class->id, $subject->id, $chapter->id]) }}">Edit Chapter</a></li>
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
                        <form role="form" method="POST" action="{{ route('teacher.chapter.update', $chapter) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
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
                                {{-- {{ dd($chapter) }} --}}
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Chapter Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $chapter->name) }}">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h4>Video Details</h4>
                                {{-- {{ dd($media) }} --}}
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group col-md-12">
                                        <label for="media_title">Video Title:</label>
                                        <input type="text" class="form-control" id="media_title" name="media_title" value="{{ old('media_title', $media ? $media->title : '' ) }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="video">Replace Video:</label>
                                        <input type="file" class="form-control" id="video" name="video">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="is_demo">Is It Demo Video </label>
                                        <input type="checkbox" name="is_demo" {{ $media ?  $media->is_demo == 1 ? 'checked' : '' : '' }}>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="video">Your Video:</label>
                                    @if ($media)
                                    <video width="100%" controls>
                                        <source src="{{ $media->media_url }}" type="video/{{ $media->media_type }}">
                                        Your browser does not support the video tag.
                                    </video>
                                    @else
                                        <p>No Media Found</p>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h4>Attach Notes/Assignments</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="notes">Add Files:</label>
                                        <input type="file" class="form-control" id="notes" name="notes[]" multiple>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="notes">Your Files:</label>
                                        @if ($notes->count())
                                            @foreach ($notes as $note)
                                                <a href="{{ $note->file }}" class="d-block" target="_blank" style="text-decoration: underline;">View file.{{ $note->type }}</a>
                                            @endforeach
                                        @else
                                            <p>No Files Found</p>
                                        @endif

                                        {{-- <input type="file" class="form-control" id="notes" name="notes[]" multiple> --}}
                                    </div>
                                </div>
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
