<?php

namespace App\Http\Controllers\admin;

use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

  /* Our Code */

  public function index() {
    $Questions = Question::all();
    // return view('admin-views.Question.index', compact('Questions'));
    return $Questions;

    // return view('admin.Questions', compact([
    //     'Questions'
    // ]));
}
public function create()
{
    $classes = Chapter::all();
    // will serve add-Question page
    // return view('categories.create');
}

public function store(Request $request)
{
  $question = Question::create([
      'chapter_id'=>$request->chapter_id,
      'name'=>$request->name,
      'marks'=>$request->marks,
      'type'=>$request->type,
      'status'=>$request->status
  ]);

  // if question is MCQ then store options.
  if($question->type == 1)
  {
    for($i=1; $i<=4; $i++) 
    {
      $opt = "option_".$i;
      $isCorrect = "radio_".$i;

      Option::create([
        'question_id'=>$question->id,
        'option'=> $request->$opt,
        'is_correct'=>$request->$isCorrect
      ]);
    }
  }
    return $question;
    // session()->flash('success', 'Question Added successfully!');
    // return redirect(route('questions.index'));
}

public function show()
{
    //
}

public function edit()
{
    // will serve edit-Question page (containing update btn)
    // return view('categories.edit', compact([
    //     'category'
    // ]));
}

public function update(Request $request, Question $question)
{ 
    $question->chapter_id = $request->chapter_id;
    $question->name = $request->name;
    $question->marks = $request->marks;
    $question->type = $request->type;
    $question->status = $request->status;

  // if question is MCQ then update options too.
  if($question->type == 1)
  {
    $options = Option::where('question_id', $question->id)->get();

    $i = 1;
    foreach($options as $option)
    {
      $opt = "option_".$i;
      $isCorrect = "radio_".$i;

      $option->question_id = $question->id;
      $option->option = $request->$opt;
      $option->is_correct = $request->$isCorrect;

      $option->update();

      $i++;
    }
  }
    $question->update();
}

public function destroy(Question $question)
{   
    if($question->type == 1)
    {
      Option::where('question_id', $question->id)->delete();
    }

    $question->delete();
    
    // session()->flash('success', 'Question Deleted Successfully!');
    // return redirect(route('categories.index'));
}

public function restore($id)
{
  Question::withTrashed()->find($id)->restore();
  // $question = Question::onlyTrashed()->where('id', $id)->get();
  $question = Question::find($id);

  if($question->type == 1)
  {
    Option::where('question_id', $question->id)->restore();
  }
  
    // return redirect()->back();
}

/* Our Code Ended */

  /*
  public function index()
  {
    $data['question'] = Question::orderBy('createdAt', 'desc')->get();
    return view('admin.question.index', $data);
  }
  public function add()
  {
    return view('admin.question.add');
  }
  public function addPost()
  {
    $question_data = array(
      'QuestionID' => Request::get('QuestionID'),
      'orderID' => Request::get('orderID'),
      'questionTitle' => Request::get('questionTitle'),
      'questionType' => Request::get('questionType'),
      'courseID' => Request::get('courseID'),
      'status' => 1,
    );

    $question_id = Question::insert($question_data);
    return redirect()->route('question')->with('message', 'Question successfully added');
  }
  public function delete($id)
  {
    $question = Question::find($id);
    $question->delete();
    return redirect()->route('question')->with('message', 'Question deleted successfully.');
  }
  public function edit($id)
  {
    $data['question'] = Question::find($id);
    return view('admin.question.edit', $data);
  }
  public function editPost()
  {
    $id = Request::get('questionID');

    $question = Question::find($id);

    $question_data = array(
      'QuestionID' => Request::get('QuestionID'),
      'orderID' => Request::get('orderID'),
      'questionTitle' => Request::get('questionTitle'),
      'questionType' => Request::get('questionType'),
      'courseID' => Request::get('courseID'),
      'status' => 1,
    );
    $question_id = Question::where('questionID', '=', $id)->update($question_data);
    return redirect()->route('question')->with('message', 'Question Updated successfully');
  }


  public function changeStatus($id)
  {
    $question = Question::find($id);
    $question->status = !$question->status;
    $question->save();
    return redirect()->route('question')->with('message', 'Questione question status successfully');
  }

  */
}
