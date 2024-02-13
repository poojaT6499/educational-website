<?php

namespace App\Http\Controllers\admin;

use App\Models\Submission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class SubmissionController extends Controller
{
  public function index()
  {
    $data['submission'] = Submission::orderBy('createdAt', 'desc')->get();
    return view('admin.submission.index', $data);
  }
  public function add()
  {
    return view('admin.submission.add');
  }
  public function addPost()
  {
    $submission_data = array(
      'questionID' => Request::get('questionID'),
      'chapterID' => Request::get('chapterID'),
      'courseID' => Request::get('courseID'),
      'userID' => Request::get('userID'),
      'status' => 1,
    );

    $submission_id = Submission::insert($submission_data);
    return redirect()->route('submission')->with('message', 'Assignment successfully added');
  }
  public function delete($id)
  {
    $submission = Submission::find($id);
    $submission->delete();
    return redirect()->route('submission')->with('message', 'Assignment deleted successfully.');
  }
  public function edit($id)
  {
    $data['submission'] = Submission::find($id);
    return view('admin.submission.edit', $data);
  }
  public function editPost()
  {
    $id = Request::get('submissionID');

    $class = Submission::find($id);

    $class_data = array(
      'questionID' => Request::get('questionID'),
      'chapterID' => Request::get('chapterID'),
      'courseID' => Request::get('courseID'),
      'userID' => Request::get('userID'),
    );
    $submission_id = Submission::where('submissionID', '=', $id)->update($class_data);
    return redirect()->route('submission')->with('message', 'Assignment Updated successfully');
  }


  public function changeStatus($id)
  {
    $submission = Submission::find($id);
    $submission->status = !$submission->status;
    $submission->save();
    return redirect()->route('submission')->with('message', 'Change Assignment status successfully');
  }
}
