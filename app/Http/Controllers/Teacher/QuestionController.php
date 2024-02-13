<?php

namespace App\Http\Controllers\teacher;

use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Option;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{

    /* Our Code */

    public function index()
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $subjects = $teacher->subjects;
        $sub_ids = $subjects->pluck('id')->toArray();
        $chapters = Chapter::whereIn('subject_id', $sub_ids)->get();
        $chapter_ids = $chapters->pluck('id')->toArray();
        $questions = Question::whereIn('chapter_id', $chapter_ids)->get();
        // dd($questions);

        return view('teacher.question.index', compact([
            'subjects',
            'chapters',
            'questions'
        ]));
    }


    public function create()
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $subjects = $teacher->subjects;
        $sub_ids = $subjects->pluck('id')->toArray();
        $chapters = Chapter::whereIn('subject_id', $sub_ids)->get();

        return view('teacher.question.create', compact([
            'subjects',
            'chapters'
        ]));
    }

    public function store(Request $request)
    {
        // dd(isset($request->w_question));
        // dd($request);
        $type = '';
        $question = '';
        if(isset($request->m_question)) {
            $type = 1;
            $question = $request->m_question;
        } else {
            $type = 0;
            $question = $request->w_question;
        }

        $question = Question::create([
            'chapter_id' => $request->chapter_id,
            'name' => $question,
            'marks' => $request->marks,
            'type' => $type,
            'status' => 0
        ]);

        // if question is MCQ then store options.
        if($type == 1)
        {
            // for($i=1; $i<=4; $i++)
            // {
            //     $opt = "option".$i;
            //     $isCorrect = $request->optionRadios;
            //     dd($request->$isCorrect);
            //     if($request->optionRadios == 1) {

            //     }
            //     Option::create([
            //         'question_id' => $question->id,
            //         'option' => $request->$opt,
            //         'is_correct' => '0'
            //     ]);
            // }


            $option1 = Option::create([
                'question_id'=>$question->id,
                'option'=>$request->option1,
                'is_correct' => '0'
            ]);
            $option2 = Option::create([
                'question_id'=>$question->id,
                'option'=>$request->option2,
                'is_correct' => '0'
            ]);
            $option3 = Option::create([
                'question_id'=>$question->id,
                'option'=>$request->option3,
                'is_correct' => '0'
            ]);
            $option4 = Option::create([
                'question_id'=>$question->id,
                'option'=>$request->option4,
                'is_correct' => '0'
            ]);


            if($request->optionRadios == 1)
            {
                Option::where('id',$option1->id)->update(['is_correct'=> 1]);
            }
            else if($request->optionRadios == 2)
            {
                Option::where('id',$option2->id)->update(['is_correct'=> 1]);
            }
            else if($request->optionRadios == 3)
            {
                Option::where('id',$option3->id)->update(['is_correct'=> 1]);
            }
            else if($request->optionRadios == 4)
            {
                Option::where('id',$option4->id)->update(['is_correct'=> 1]);
            }
        }
        return redirect(route('teacher.question'));
        // return $question;
        // session()->flash('success', 'Question Added successfully!');
        // return redirect(route('questions.index'));
    }

    public function show($chapter_id)
    {
        $chapter = Chapter::find($chapter_id);
        $questions = $chapter->questions()->get();

        return $questions;
    }

    public function edit(Question $question)
    {
        // dd($question);

        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $subjects = $teacher->subjects;
        $sub_ids = $subjects->pluck('id')->toArray();
        // $chapters = Chapter::whereIn('subject_id', $sub_ids)->get();

        $options = Option::where('question_id', $question->id)->get();
        $chapter = Chapter::where('id', $question->chapter_id)->first();
        $subject = Subject::where('id', $chapter->subject_id)->first();
        $chapters = Chapter::where('subject_id', $subject->id)->get();
        // dd($subject);
        // will serve edit-Question page (containing update btn)
        return view('teacher.question.edit', compact([
            'subjects',
            'subject',
            'chapters',
            'chapter',
            'question',
            'options'
        ]));
    }

    public function update(Request $request, Question $question)
    {
        // dd($request);
        $options = Option::where('question_id', $question->id)->get();
        // dd($options);
        $type = '';
        $ques = '';
        if(isset($request->m_question)) {
            $type = 1;
            $ques = $request->m_question;
        } else {
            $type = 0;
            $ques = $request->w_question;
        }

        $question->chapter_id = $request->chapter_id;
        $question->name = $ques;
        $question->marks = $request->marks;
        $question->type = $type;
        $question->status = 0;
        $question->update();

        // if question is MCQ then store options.
        if($type == 1)
        {
            $options[0]->update([
                'question_id' => $question->id,
                'option' => $request->option1,
                'is_correct' => '0'
            ]);
            $options[1]->update([
                'question_id' => $question->id,
                'option' => $request->option2,
                'is_correct' => '0'
            ]);
            $options[2]->update([
                'question_id' => $question->id,
                'option' => $request->option3,
                'is_correct' => '0'
            ]);
            $options[3]->update([
                'question_id' => $question->id,
                'option' => $request->option4,
                'is_correct' => '0'
            ]);


            if($request->optionRadios == 1)
            {
                Option::where('id', $options[0]->id)->update(['is_correct'=> 1]);
            }
            else if($request->optionRadios == 2)
            {
                Option::where('id', $options[1]->id)->update(['is_correct'=> 1]);
            }
            else if($request->optionRadios == 3)
            {
                Option::where('id', $options[2]->id)->update(['is_correct'=> 1]);
            }
            else if($request->optionRadios == 4)
            {
                Option::where('id', $options[3]->id)->update(['is_correct'=> 1]);
            }
        }
        return redirect(route('teacher.question'));
        // $question->chapter_id = $request->chapter_id;
        // $question->name = $request->name;
        // $question->marks = $request->marks;
        // $question->type = $request->type;
        // $question->status = $request->status;

        // // if question is MCQ then update options too.
        // if($question->type == 1)
        // {
        //     $options = Option::where('question_id', $question->id)->get();

        //     $i = 1;
        //     foreach($options as $option)
        //     {
        //     $opt = "option_".$i;
        //     $isCorrect = "radio_".$i;

        //     $option->question_id = $question->id;
        //     $option->option = $request->$opt;
        //     $option->is_correct = $request->$isCorrect;

        //     $option->update();

        //     $i++;
        //     }
        // }
        // $question->update();
    }

    public function destroy(Question $question)
    {
        // dd($question);
        if($question->type == 1)
        {
            Option::where('question_id', $question->id)->delete();
        }

        $question->delete();
        return redirect(route('teacher.question'));
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

    public function getChapters($subject_id) {

        $chapters = Chapter::where('subject_id', $subject_id)->get();
        // dd($subjects);
        return response()->json(array('chapters'=> $chapters), 200);
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
