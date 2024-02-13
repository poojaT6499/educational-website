@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Assign Subjects To {{ $teacher->name }}</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}"> Home </a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.teacher') }}"> Teachers </a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.teacher.show', $teacher) }}"> View Teacher </a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Details</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.teacher.assign') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <span class="text-muted">Teacher Name: </span> <p class="d-inline">{{ $teacher->name }}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <span class="text-muted">Phone: </span> <p class="d-inline">{{ $teacher->phone }}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <span class="text-muted">Email: </span> <p class="d-inline">{{ $teacher->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <h4 class="card-title">Assign Subjects</h4>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Select Class:</label>
                                <select id="classes" class="form-control" name="class_id" onchange="getChapters(this.value);">
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Select Subject:</label>
                                <select id="subjects" class="form-control" name="subject_id">
                                </select>
                            </div>
                            <div>
                                {{-- <label>$nbsp;</label> --}}
                                <br>
                                <input type="text" name="user_id" value="{{ $teacher->id }}" hidden>
                                <button type="submit" class="btn btn-primary mt-2 ml-3">Assign</button>
                            </div>

                        </div>

                    </form>

                    @if(Session::has('message'))
                    <div class="alert alert-success">
                        <strong><span class="glyphicon glyphicon-ok"></span>{{ Session::get('message') }}</strong>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <?php
                            $classes = $realTeacher->classes;
                            $subjects = $realTeacher->subjects;
                        ?>
                        @if(count($classes)>0)
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Class</th>
                                    <th>Subject Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=1;
                                    $j=0;
                                ?>
                                @foreach($classes as $class)

                                <tr>
                                    <td>{{$i}} </td>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $subjects[$j]->name }}</td>
                                    <td>
                                        <a href="{{ route('') }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
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

@section('scripts')
{{-- <script src="{{ asset('js/jquery.min.js') }}" defer></script> --}}

<script>
// $(document).ready(function() {
//     console.log( "document loaded" );
// });
window.onload = function() {
    getChapters(1);
};

function removeOptions(selectElement) {
    var i, L = selectElement.options.length - 1;
    for(i = L; i >= 0; i--) {
        selectElement.remove(i);
    }
}

// using the function:
function getChapters(class_id) {
    var subjectsSelect = document.getElementById('subjects');
    removeOptions(subjectsSelect);
    $.ajax({
        type: 'GET',
        url: `{{url('/admin/classes/${class_id}/getSubjects')}}`,
        data:'_token = <?php echo csrf_token() ?>',
        success: function(response) {
            var subjects = response.subjects;
            subjects.forEach(subject => {
                var subjectsSelect = document.getElementById('subjects');
                subjectsSelect.options[subjectsSelect.options.length] = new Option(subject.name, subject.id);
            });
            $(subjectsSelect).selectpicker('refresh');
        }
    });
};

</script>

@endsection
