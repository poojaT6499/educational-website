@extends('layouts.teacher.app')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>All Sessions</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('teacher.session') }}">Sessions</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Sessions</h4>
                    <a href="{{ route('teacher.session.create') }}" class="btn btn-primary">Create Session</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        @if(count($sessions)>0)
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Class & Subject</th>
                                    <th>Chapter</th>
                                    <th>Session Title</th>
                                    <th>Date & Time</th>
                                    <th>Link</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach($sessions as $session)
                                <tr>
                                    <td>{{ $i++ }} </td>
                                    <td>
                                        <?php
                                            $sub_id = 0;
                                            $class_id = 0;
                                            $sub_name = "";
                                            $class_name = "";
                                            foreach ($chapters as $chap){
                                                if($chap->id == $session->chapter_id)
                                                    $sub_id = $chap->subject_id;
                                            }
                                            foreach ($subjects as $sub) {
                                                if ($sub->id == $sub_id) {
                                                    $class_id = $sub->class_id;
                                                    $sub_name = $sub->name;
                                                }
                                            }
                                            foreach ($classes as $class) {
                                                if ($class->id == $class_id) {
                                                    $class_name = $class->name;
                                                }
                                            }
                                        ?>
                                        {{ $class_name }} - {{ $sub_name }}
                                    </td>
                                    <td>
                                        @foreach ($chapters as $chap)
                                            @if ($chap->id == $session->chapter_id)
                                                {{ $chap->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $session->title }}
                                    </td>
                                    <td>{{ date('d M, Y H:i A', strtotime($session->schedule_time)); }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{$session->link}}" target="_blank">Attend</a>
                                    </td>
                                    <td>{{ $session->type ? 'Doubts Session' : 'Live Session' }}</td>
                                    <td>
                                        <a href="{{ route('teacher.session.edit', $session) }}" class="btn btn-sm btn-warning"><i class="la la-pencil"></i></a>
                                        <a href="{{ route('teacher.session.delete', $session) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                    </td>
                                </tr>
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
    </div>
</div>

@endsection
