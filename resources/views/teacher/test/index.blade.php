@extends('layouts.teacher.app')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>All Tests</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('teacher.test') }}">Test</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Tests</h4>
                    <a href="{{ route('teacher.test.create') }}" class="btn btn-primary">Add Test</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if(count($tests)>0)
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Class & Subject</th>
                                    <th>Title</th>
                                    <th>Total Marks</th>
                                    <th>Duration</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=1;
                                    $j=0;
                                ?>
                                @foreach($tests as $test)
                                <tr>
                                    <td>{{ $i }} </td>
                                    <td>
                                        <?php
                                            $sub_id = $test->subject_id;
                                            $class_id = 0;
                                            $sub_name = "";
                                            $class_name = "";

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
                                    <td>{{ $test->title }}</td>
                                    <td>{{ $test->total_marks }}</td>
                                    <td>{{ $test->duration }}</td>
                                    {{-- <td>{{ $test->status ? 'Published' : 'Pending For Approval' }}</td> --}}
                                    <td>
                                        <a href="{{ route('teacher.test.edit', $test) }}" class="btn btn-sm btn-warning"><i class="la la-pencil"></i></a>
                                        <a href="" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
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
