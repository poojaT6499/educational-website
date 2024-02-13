@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit Student</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.student') }}">Students</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.student.create') }}">Edit Student</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.student.update', $student) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Student Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $student->name) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Phone:</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $student->phone) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $student->email) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" value="{{ old('password', $student->password) }}" required>
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
