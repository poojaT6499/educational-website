@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Add Teacher</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.teacher') }}">Teachers</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.teacher.create') }}">Add Teacher</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.teacher.store') }}">
                            @csrf
                            {{-- <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Class</label>
                                    <select id="classes" class="form-control" name="class_id" onchange="getChapters(this.value);">
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Subjects</label>
                                    <select id="subjects" class="form-control" name="subject_id">
                                    </select>
                                </div>
                            </div> --}}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Teacher Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Phone:</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
                                </div>
                            </div>
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
