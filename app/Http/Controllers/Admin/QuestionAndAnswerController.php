<?php

namespace App\Http\Controllers\admin;

use App\Models\QuestionAndAnswer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class QuestionAndAnswerController extends Controller
{
  public function index()
  {
    $data['questionAnswer'] = QuestionAndAnswer::orderBy('createdAt', 'desc')->get();
    return view('admin.question&Answer.index', $data);
  }
  public function add()
  {
    return view('admin.question&Answer.add');
  }
  public function addPost()
  {
    $quesAnswer_data = array(
      'questionID' => Request::get('questionID'),
      'answerID' => Request::get('answerID'),
      'status' => 1,
    );

    $quesAnswer_id = QuestionAndAnswer::insert($quesAnswer_data);
    return redirect()->route('questionandanswer')->with('message', 'Question & Answer successfully added');
  }
  public function delete($id)
  {
    $questionAnswer = QuestionAndAnswer::find($id);
    $questionAnswer->delete();
    return redirect()->route('questionandanswer')->with('message', 'Question & Answer deleted successfully.');
  }
  public function edit($id)
  {
    $data['questionAnswer'] = QuestionAndAnswer::find($id);
    return view('admin.question&Answer.edit', $data);
  }
  public function editPost()
  {
    $id = Request::get('questionAnswerID');

    $questionAnswer = QuestionAndAnswer::find($id);

    $questionAnswer_data = array(
      'questionID' => Request::get('questionID'),
      'answerID' => Request::get('answerID'),
    );
    $questionAnswer_id = QuestionAndAnswer::where('questionAnswerID', '=', $id)->update($questionAnswer_data);
    return redirect()->route('questionandanswer')->with('message', 'answer Updated successfully');
  }


  public function changeStatus($id)
  {
    $questionAnswer = QuestionAndAnswer::find($id);
    $questionAnswer->status = !$questionAnswer->status;
    $questionAnswer->save();
    return redirect()->route('questionandanswer')->with('message', 'Change answer status successfully');
  }
}
