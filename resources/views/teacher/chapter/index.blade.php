@extends('layouts.teacher.app')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>All Chapters</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('teacher.chapter') }}">Chapter</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Chapters</h4>
                    {{-- {{ dd() }} --}}
                    <a href="{{ route('teacher.chapter.create', [$class->id, $subject->id]) }}" class="btn btn-primary">Add Chapter</a>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <span class="text-muted">Class Name: </span> <p class="d-inline">{{ $class->name }}</p>
                        </div>
                        <div class="form-group col-md-4">
                            <span class="text-muted">Subject Name: </span> <p class="d-inline">{{ $subject->name }}</p>
                        </div>
                        {{-- <div class="form-group col-md-4">
                            <span class="text-muted">Email: </span> <p class="d-inline">{{ $teacher->email }}</p>
                        </div> --}}
                    </div>
                    <hr>
                    @if(Session::has('message'))
                    <div class="alert alert-success">
                        <strong><span class="glyphicon glyphicon-ok"></span>{{ Session::get('message') }}</strong>
                    </div>
                    @endif
                    <div class="table-responsive">
                        @if(count($chapters)>0)
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Chapter Name</th>
                                    <th>Video Title</th>
                                    <th>Video</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=1;
                                    $j=0;
                                ?>
                                @foreach($chapters as $chapter)
                                    {{-- {{ dd($medias) }} --}}
                                <tr>
                                    <td>{{ $i }} </td>
                                    <td>{{ $chapter->name }}</td>
                                    <td>
                                        @if ($medias->count())
                                        {{ $medias[$j]->title }}
                                        @else
                                            No Media Found
                                        @endif
                                    </td>
                                    <td>
                                        @if ($medias->count())
                                        <video width="220" height="140" controls>
                                            <source src="{{ $medias[$j]->media_url }}" type="video/{{ $medias[$j]->media_type }}">
                                            Your browser does not support the video tag.
                                        </video>
                                        @else
                                            No Media Found
                                        @endif

                                    </td>
                                    <td>{{ $chapter->status ? 'Published' : 'Pending For Approval' }}</td>
                                    <td>
                                        {{-- <a href="{{ route('teacher.chapter.edit', $chapter) }}" class="btn btn-sm btn-primary"><i class="ti-clip"></i> Attach</a> --}}
                                        <a href="{{ route('teacher.chapter.edit', [$class, $subject, $chapter]) }}" class="btn btn-sm btn-warning"><i class="la la-pencil"></i></a>
                                        <a href="{{ route('teacher.chapter.delete', $chapter) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                    </td>
                                </tr>

                                <?php
                                    $i++;
                                    $j++;
                                ?>
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
    </div>
</div>

@endsection
