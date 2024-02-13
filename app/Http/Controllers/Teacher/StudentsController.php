<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Enrollment;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $students = User::where('role', '2')->get();
        // $teacher = Teacher::where('user_id', Auth()->user()->id);
        // $classes = $teacher->classes;

        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $subjects = $teacher->subjects;
        $sub_ids = $subjects->pluck('id')->toArray();
        $enrollments = Enrollment::whereIn('subject_id', $sub_ids)->get();
        $user_ids = $enrollments->pluck('user_id')->toArray();
        $students = User::whereIn('id', $user_ids)->get();
        // dd($students);

        return view('teacher.student.index', compact([
            'students',
        ]));
    }
}
