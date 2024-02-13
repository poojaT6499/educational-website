@extends('admin.inc.base')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>All Chapter</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{Request::root()}}/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/Chapter">Chapter</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/Chapter/add-Chapter">Add
                        Chapter</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3">
                <li class="nav-item"><a href="#list-view" data-toggle="tab"
                        class="nav-link btn-primary mr-1 show active">List View</a></li>
                <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid View</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Chapter </h4>
                            <a href="{{Request::root()}}/admin/Chapter/add-Chapter" class="btn btn-primary">+ Add
                                new</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('message'))
                            <div class="alert alert-success">
                                <strong><span class="glyphicon glyphicon-ok"></span>{{ Session::get('message')
                                    }}</strong>
                            </div>
                            @endif
                            <div class="table-responsive">
                                @if(count($Chapters)>0)
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>SL No</th>
                                            <th>Course</th>
                                            <th>Live Session</th>
                                            <th>Video URL</th>
                                            <th>Order</th>
                                            <th>Assignments</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1 ?>
                                        @foreach($Chapters as $Chapter)

                                        <tr>
                                            <td>{{$i}} </td>
                                            <td>{{$Chapter->CourseTitle }}</td>
                                            <td>{{ $Chapter->IsLiveSession }}</td>
                                            <td>{{Str::substr($Chapter->VideoUrl,0,30) }}</td>
                                            <td>{{$Chapter->OrderNo}}</td>
                                            <td>{{$Chapter->Assignments}}</td>

                                            <td>
                                                <a href="{{Request::root()}}/admin/Chapter/change-status-Chapter/{{ $Chapter->ChapterID }}"
                                                    class="btn btn-sm btn-warning"> @if($Chapter->Status==1)
                                                    {{"Activate"}} @else {{"Dectivate"}} @endif </a>



                                                <a href="{{Request::root()}}/admin/Chapter/edit-Chapter/{{ $Chapter->ChapterID }}"
                                                    class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                <a href="{{Request::root()}}/admin/Chapter/delete-Chapter/{{ $Chapter->ChapterID }}"
                                                    onclick="return confirm('are you sure to delete')"
                                                    class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                            </td>
                                        </tr>

                                        <?php $i++;  ?>
                                        @endforeach
                                    </tbody>
                                </table>

                                @else
                                <div class="alert alert-info" role="alert">
                                    <strong>No Plan Found!</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div id="grid-view" class="tab-pane fade col-lg-12">
                    <div class="row">
                        @foreach($Chapters as $Chapter)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card card-profile">
                                <div class="card-header justify-content-end pb-0">
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" data-toggle="dropdown">
                                            <span class="dropdown-dots fs--1"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right border py-0">
                                            <div class="py-2">
                                                <a href="{{Request::root()}}/admin/banner/view-banner/{{ $Chapter->ChapterID }}"
                                                    class="ml-4"> @if($Chapter->status==1) {{"Activate"}} @else
                                                    {{"Dectivate"}} @endif </a>

                                                <a href="{{Request::root()}}/admin/banner/edit-banner/{{$Chapter->ChapterID}}"
                                                    class="ml-4">Edit</a>
                                                <a href="{{Request::root()}}/admin/banner/delete-banner/{{$Chapter->ChapterID}}"
                                                    onclick="return confirm('are you sure to delete')" class="ml-4">
                                                    Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <div class="text-center">
                                        {{-- <div class="profile-photo">
                                            <img src="{{ asset('/uploads/').'/'. $Chapter->bannerImg }}" width="100"
                                                height="200" class="img-fluid rounded-circle" alt="">
                                        </div> --}}
                                        <h3 class="mt-4 mb-1">{{$Chapter->CourseTitle }}</h3>


                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection