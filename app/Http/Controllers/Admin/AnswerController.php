<?php

namespace App\Http\Controllers\admin;

use App\Models\Answer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class AnswerController extends Controller
{
  public function index()
  {
    $data['answer'] = Answer::orderBy('createdAt', 'desc')->get();
    return view('admin.Answer.index', $data);
  }
  public function add()
  {
    return view('admin.Answer.add');
  }
  public function addPost()
  {
    $Answer_data = array(
      'questionID' => Request::get('questionID'),
      'questionType' => Request::get('questionType'),
      'answerList' => Request::get('answerList'),
      'correctAnswer' => Request::get('correctAnswer'),
      'status' => 1,
    );

    $Answer_id = Answer::insert($Answer_data);
    return redirect()->route('answer')->with('message', 'Answer successfully added');
  }
  public function delete($id)
  {
    $Answer = Answer::find($id);
    $Answer->delete();
    return redirect()->route('answer')->with('message', 'Answer deleted successfully.');
  }
  public function edit($id)
  {
    $data['answer'] = Answer::find($id);
    return view('admin.Answer.edit', $data);
  }
  public function editPost()
  {
    $id = Request::get('AnswerID');

    $class = Answer::find($id);

    $question_data = array(
      'questionID' => Request::get('questionID'),
      'questionType' => Request::get('questionType'),
      'answerList' => Request::get('answerList'),
      'correctAnswer' => Request::get('correctAnswer'),
    );
    $Answer_id = Answer::where('AnswerID', '=', $id)->update($question_data);
    return redirect()->route('answer')->with('message', 'Answer Updated successfully');
  }


  public function changeStatus($id)
  {
    $Answer = Answer::find($id);
    $Answer->status = !$Answer->status;
    $Answer->save();
    return redirect()->route('answer')->with('message', 'Change Answer status successfully');
  }
}
