@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit Teacher</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.teacher') }}">Teachers</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.teacher.create') }}">Edit Teacher</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.teacher.update', $teacher) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Teacher Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $teacher->name) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Phone:</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $teacher->email) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" value="{{ old('password', $teacher->password) }}" required>
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
