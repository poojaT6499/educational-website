@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit Classes</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.classes') }}">Classes</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.classes.edit', $class) }}">Edit Classes</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.classes.update', $class) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Class Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $class->name) }}">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" {{ $class->status == 1 ? 'checked' : '' }}>
                                    <label for="status" class="form-check-label">
                                        Status (Active/Inactive)
                                    </label>
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
