@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit Subject</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.subject') }}">Subjects</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.subject.edit', $subject) }}">Edit Subject</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.subject.update', $subject) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Class</label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option selected="-1">Choose Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" {{ $class->id == $subject->class_id ? "selected" : "" }}>{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="name">Subject Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $subject->name) }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" {{ $subject->status == 1 ? 'checked' : '' }}>
                                        <label for="status" class="form-check-label">
                                            Status (Active/Inactive)
                                        </label>
                                    </div>
                                </div>
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
