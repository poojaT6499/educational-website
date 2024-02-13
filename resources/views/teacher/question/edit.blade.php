@extends('layouts.teacher.app')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit Question</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="">Questions</a></li>
                <li class="breadcrumb-item active"><a href="">Edit Question</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">

                        <form method="POST" action="{{ route('teacher.question.update', $question) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
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
                                <h4>Question Details</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link {{ $question->type ? 'active' : '' }}" id="nav-mcq-tab" data-toggle="tab" data-target="#nav-mcq" type="button" role="tab" aria-controls="nav-mcq" aria-selected="true">MCQ</button>
                                            <button class="nav-link {{ $question->type ? '' : 'active' }}" id="nav-written-tab" data-toggle="tab" data-target="#nav-written" type="button" role="tab" aria-controls="nav-written" aria-selected="false">Written</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade {{ $question->type ? 'show active' : '' }}" id="nav-mcq" role="tabpanel" aria-labelledby="nav-mcq-tab">
                                            <div class="row mt-3">
                                                <div class="form-group col-md-12">
                                                    <label for="m_question">Question: </label>
                                                    <input type="text" class="form-control" id="media_title" name="m_question" value="{{  $question->type ? $question->name : '' }}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-10">
                                                            <label for="option1">Option 1: </label>
                                                            <input type="text" class="form-control" id="option1" name="option1" value="{{  $question->type ? $options[0]->option : '' }}">
                                                        </div>
                                                        <div class="col-md-2 p-4" style="margin-top: 0.5rem;">
                                                            <input class="form-check-input"  name="optionRadios" type="radio" value="1" id="radio1" {{ $question->type ? ($options[0]->is_correct ? 'checked' : '') : '' }}>
                                                            <label class="form-check-label" for="radio1">
                                                                Correct
                                                            </label>
                                                        </div>
                                                        <div class="form-group col-md-10">
                                                            <label for="option2">Option 2: </label>
                                                            <input type="text" class="form-control" id="option2" name="option2" value="{{  $question->type ? $options[1]->option : '' }}">
                                                        </div>
                                                        <div class="col-md-2 p-4" style="margin-top: 0.5rem;">
                                                            <input class="form-check-input"  name="optionRadios" type="radio" value="2" id="radio2" {{ $question->type ? ($options[1]->is_correct ? 'checked' : '') : '' }}>
                                                            <label class="form-check-label" for="radio2">
                                                                Correct
                                                            </label>
                                                        </div>
                                                        <div class="form-group col-md-10">
                                                            <label for="option3">Option 3: </label>
                                                            <input type="text" class="form-control" id="option3" name="option3" value="{{  $question->type ? $options[2]->option : '' }}">
                                                        </div>
                                                        <div class="col-md-2 p-4" style="margin-top: 0.5rem;">
                                                            <input class="form-check-input"  name="optionRadios" type="radio" value="3" id="radio3" {{ $question->type ? ($options[2]->is_correct ? 'checked' : '') : '' }}>
                                                            <label class="form-check-label" for="radio3">
                                                                Correct
                                                            </label>
                                                        </div>
                                                        <div class="form-group col-md-10">
                                                            <label for="option4">Option 4: </label>
                                                            <input type="text" class="form-control" id="option4" name="option4" value="{{  $question->type ? $options[3]->option : '' }}">
                                                        </div>
                                                        <div class="col-md-2 p-4" style="margin-top: 0.5rem;">
                                                            <input class="form-check-input"  name="optionRadios" type="radio" value="4" id="radio4" {{ $question->type ? ($options[3]->is_correct ? 'checked' : '') : '' }}>
                                                            <label class="form-check-label" for="radio4">
                                                                Correct
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade {{ $question->type ? '' : 'show active' }}" id="nav-written" role="tabpanel" aria-labelledby="nav-written-tab">
                                            <div class="row mt-3">
                                                <div class="form-group col-md-12">
                                                    <label for="w_question">Question: </label>
                                                    <input type="text" class="form-control" id="w_question" name="w_question" value="{{  $question->type ? '' : $question->name }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="notes">Marks:</label>
                                <input type="number" class="form-control" id="notes" name="marks" min="1" value="{{ $question->marks }}" required>
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
    // updateChapters(1);
};

function removeOptions(selectElement) {
    var i, L = selectElement.options.length - 1;
    for(i = L; i >= 0; i--) {
        selectElement.remove(i);
    }
}

// using the function:
function updateChapters(sub_id) {
    var chaptersSelect = document.getElementById('chapters');
    removeOptions(chaptersSelect);
    $.ajax({
        type: 'GET',
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
