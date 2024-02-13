<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\McqSubmission;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class McqSubmissionController extends Controller
{
    /* Our Code */

  public function index() {
    $teacher = Teacher::find(1);//Auth::user();
    $classes = $teacher->classes()->get();
    $subjects = $teacher->subjects()->get();
    // From subjects u will get tests and from test u will get submissions(MCQ and Written).
    

    // return view('admin.McqSubmissions', compact([
    //     'McqSubmissions'
    // ]));
  }
    /* Our Code ENDED*/
}
