@extends('layouts.teacher.app')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Students</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.subject') }}">Subjects</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        {{-- {{ dd($subjects) }} --}}
        @foreach($classes as $class)
            <div class="col-md-12">
                <h4>{{ $class->name }}</h4>
            </div>
            @foreach ($subjects as $subject)
                @if ($subject->class_id == $class->id)
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <a href="{{ route('teacher.subject.chapter', [$class->id, $subject->id]) }}">
                        <div class="card card-profile" height="300px">
                            {{-- <div class="card-header justify-content-end pb-0">
                                <div class="dropdown">
                                    <button class="btn btn-link" type="button" data-toggle="dropdown">
                                        <span class="dropdown-dots fs--1"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right border py-0">
                                        <div class="py-2">
                                            <a href="{{ route('teacher.chpaters', $subject) }}" class="ml-4"> View </a>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="card-body pt-2">
                                <div class="text-center">
                                    <h3 class="mt-4 mb-1">{{ $subject->name }}</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            @endforeach
            <hr width="100%">
        @endforeach
    </div>

</div>

@endsection
