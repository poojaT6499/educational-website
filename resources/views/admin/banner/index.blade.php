@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Banners</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("admin") }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route("admin.banner") }}">Banner</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        {{-- <div class="col-lg-12">
            <ul class="nav nav-pills mb-3">
                <li class="nav-item">
                    <a href="#list-view" data-toggle="tab" class="nav-link btn-primary mr-1 show active">List View</a>
                </li>
                <li class="nav-item">
                    <a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid View</a>
                </li>
            </ul>
        </div> --}}
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Banners </h4>
                            <a href="{{ route("admin.banner.create") }}" class="btn btn-primary"> Add Banner</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('message'))
                            <div class="alert alert-success">
                                <strong><span class="glyphicon glyphicon-ok"></span>{{ Session::get('message') }}</strong>
                            </div>
                            @endif
                            <div class="table-responsive">
                                @if(count($banners)>0)
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Order No</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1 ?>
                                        @foreach($banners as $banner)

                                        <tr>
                                            <td>{{$i}} </td>
                                            <td> {{ $banner->name }} </td>
                                            <td>
                                                <img src="{{ asset('/assets/admin/images/banners').'/'. $banner->image }}" width="200">
                                            </td>
                                            <td>{{ $banner->order }}</td>
                                            <td>{{ $banner->status ? 'Active' : 'Deactive' }}</td>
                                            <td>
                                                <a href="{{ route('admin.banner.edit', $banner) }}" class="btn btn-sm btn-warning"><i class="la la-pencil"></i></a>
                                                <a href="{{ route('admin.banner.delete', $banner) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $i++;  ?>
                                        @endforeach
                                    </tbody>
                                </table>

                                @else
                                <div class="alert alert-info" role="alert">
                                    <strong>No Data Found!</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div id="grid-view" class="tab-pane fade col-lg-12">
                    <div class="row">
                        @foreach($banners as $banner)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card card-profile">
                                <div class="card-header justify-content-end pb-0">
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" data-toggle="dropdown">
                                            <span class="dropdown-dots fs--1"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right border py-0">
                                            <div class="py-2">
                                                <a href="#" class="ml-4"> @if($banner->status==1) {{"Activate"}} @else {{"Dectivate"}} @endif
                                                </a>
                                                <a href="{{ route('admin.banner.edit', $banner) }}" class="ml-4">Edit</a>
                                                <a href="{{ route('admin.banner.delete', $banner) }}" onclick="return confirm('are you sure you want to delete')" class="ml-4"> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <div class="text-center">
                                        <div class="profile-photo">
                                            <img src="{{ asset('/assets/admin/images/banners').'/'. $banner->image }}" width="100">
                                        </div>
                                        <h3 class="mt-4 mb-1">{{ $banner->name }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>

@endsection
