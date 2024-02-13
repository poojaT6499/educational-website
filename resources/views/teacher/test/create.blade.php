@extends('layouts.teacher.app')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Add Test</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="">Tests</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('teacher.test.create') }}">Add Test</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('teacher.test.store') }}">
                        @csrf
                        <div class="mb-3">
                            <h4>Details</h4>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="d-block">Select Class</label>
                                <select id="classes" class="form-control" name="class_id" onchange="updateSubjects(this.value)">
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name" class="d-block">Select Subject</label>
                                <select id="subjects" class="form-control" name="subject_id" onchange="updateChapters(this.value)">
                                    {{-- @foreach ($subjects as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name" class="d-block">Select Chapter</label>
                                <select id="chapters" class="form-control" name="chapter_id" onchange="updateQuestions(this.value, 1)">
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name" class="d-block">Select Type</label>
                                <select id="test_type" class="form-control" name="test_type" onchange="updateQuestions(document.getElementById('chapters').value, this.value)">
                                    <option value="1" selected>MCQ</option>
                                    <option value="0">Written</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <h4>Test Details</h4>
                        </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="title">Test Title:</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="duration">Duration:</label>
                                    <input type="time" class="form-control" id="duration" name="duration" required>
                                </div>
                            </div>

                            <hr>
                            <div class="mb-3">
                                <h4>Add Questions</h4>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="d-block">Select Questions</label>
                                    <select id="questions" class="form-control" name="questions[]" onchange="calculateTotalMarks()" multiple required></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name" class="d-block">Total Marks (Auto Calculated Based On Questions)</label>
                                    <input type="total_marks" class="form-control" id="total_marks" name="total_marks" value="0" readonly>
                                </div>
                            </div>
                            <div class="row">

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
var total_marks = 0;

window.onload = function() {
    // console.log(document.getElementById("classes").value);
    // console.log("Subject Id: " + document.getElementById("subjects").value);
    updateSubjects(document.getElementById("classes").value);
    updateChapters(document.getElementById("subjects").value);
    updateQuestions(document.getElementById("chapters").value, 1);
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
            // console.log("aaa " + document.getElementById('chapters').value);
            subjects.forEach(subject => {
                var subjectsSelect = document.getElementById('subjects');
                subjectsSelect.options[subjectsSelect.options.length] = new Option(subject.name, subject.id);
            });
            updateChapters(document.getElementById('subjects').value);
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
            updateQuestions(document.getElementById('chapters').value, 1);
            $(chaptersSelect).selectpicker('refresh');
        }
    });
};


// using the function:
function updateQuestions(chp_id, type) {
    // console.log(chp_id + "Aaya " + type);
    // chp_id = 1;
    var questionsSelect = document.getElementById('questions');
    removeOptions(questionsSelect);
    $.ajax({
        type: 'GET',
        async: false,
        url: `{{url('/teacher/tests/${chp_id}/getQuestions/${type}')}}`,
        data:'_token = <?php echo csrf_token() ?>',
        success: function(response) {
            // console.log(response);
            var questions = response.questions;
            questions.forEach(question => {
                var questionsSelect = document.getElementById('questions');
                questionsSelect.options[questionsSelect.options.length] = new Option(question.name, question.id);
            });
            $(questionsSelect).selectpicker('refresh');
        }
    });
};

function calculateTotalMarks() {
    var questions = {!! json_encode($questions->toArray()) !!};

    // console.log(questions);

    const selectedQuestions = document.querySelectorAll('#questions option:checked');
    const ques_ids = Array.from(selectedQuestions).map(el => el.value);
    // console.log(ques_ids[0]);

    var i=0;
    total_marks = 0;

    questions.forEach(ques => {
        ques_ids.forEach(ids => {
            if(ques.id == ids) {
                // console.log(ques.id + "- " + ques.marks);
                total_marks += ques.marks;
            }
        });
    });
    document.getElementById("total_marks").value = total_marks;
}
</script>
@endsection
