@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit Banner</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.banner') }}">Banner</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.banner.edit', $banner) }}">Edit Banner</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.banner.update', $banner) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Title:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $banner->name) }}">
                            </div>

                            <div class="form-group">
                                <label for="image">Image:</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{ asset('assets/admin/images/banners/' . $banner->image) }}" width="100%">
                                    </div>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="order">Order:</label>
                                <input type="number" class="form-control" id="order" name="order" min="1" value="{{ old('name', $banner->order) }}">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" {{ $banner->status == 1 ? 'checked' : '' }}>
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
