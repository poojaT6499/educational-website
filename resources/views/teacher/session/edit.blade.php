@extends('layouts.teacher.app')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit Session</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="">Sessions</a></li>
                <li class="breadcrumb-item active"><a href="">Edit Session</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">

                        <form method="POST" action="{{ route('teacher.session.update', $session) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="d-block">Select Class</label>
                                    <select id="classes" class="form-control" name="class_id" onchange="updateSubjects(this.value)">
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" {{ $class->id == $cl->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name" class="d-block">Select Subject</label>
                                    <select id="subjects" class="form-control" name="subject_id" onchange="updateChapters(this.value)">
                                        @foreach ($subjects as $sub)
                                            <option value="{{ $sub->id }}" {{ $sub->id == $subject->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name" class="d-block">Select Chapter</label>
                                    <select id="chapters" class="form-control" name="chapter_id">
                                        @foreach ($chapters as $chap)
                                            <option value="{{ $chap->id }}" {{ $chap->id == $chapter->id ? 'selected' : '' }}>{{ $chap->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h4>Session Details</h4>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="title">Title:</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{  old('title', $session->title) }}" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="link">Link:</label>
                                    <input type="text" class="form-control" id="link" name="link" value="{{  old('title', $session->link) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="schedule_date">Schedule Date:</label>
                                    <input type="datetime-local" class="form-control" id="schedule_date" name="schedule_date" value="{{  old('title', $session->schedule_time) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name" class="d-block">Select Type</label>
                                    <select id="type" class="form-control" name="type">
                                        <option value="0" {{ $session->type ? '' : 'selected' }}>Live Session</option>
                                        <option value="1" {{ $session->type ? 'selected' : '' }}>Doubts Session</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

<script>

window.onload = function() {
    console.log(document.getElementById("classes").value);
    console.log("Subject Id: " + document.getElementById("subjects").value);
    updateSubjects(document.getElementById("classes").value);
    updateChapters(document.getElementById("subjects").value);
};

function removeOptions(selectElement) {
    var i, L = selectElement.options.length - 1;
    for(i = L; i >= 0; i--) {
        selectElement.remove(i);
    }
}

// using the function:
function updateSubjects(class_id) {
    var subjectsSelect = document.getElementById('subjects');
    removeOptions(subjectsSelect);
    $.ajax({
        type: 'GET',
        async: false,
        url: `{{url('/teacher/sessions/${class_id}/getSubjects')}}`,
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

// using the function:
function updateChapters(sub_id) {
    var chaptersSelect = document.getElementById('chapters');
    removeOptions(chaptersSelect);
    $.ajax({
        type: 'GET',
        async: false,
        url: `{{url('/teacher/questions/${sub_id}/getChapters')}}`,
        data:'_token = <?php echo csrf_token() ?>',
        success: function(response) {
            var chapters = response.chapters;
            chapters.forEach(chapter => {
                var chaptersSelect = document.getElementById('chapters');
                chaptersSelect.options[chaptersSelect.options.length] = new Option(chapter.name, chapter.id);
            });
            $(chaptersSelect).selectpicker('refresh');
        }
    });
};

</script>
@endsection
