<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\Teacher;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $classes = $teacher->classes;
        $subjects = $teacher->subjects;
        $sub_ids = $subjects->pluck('id')->toArray();
        $tests = Test::whereIn('subject_id', $sub_ids)->get();
        // dd($tests);

        return view('teacher.test.index', compact([
            'tests',
            'subjects',
            'classes',
        ]));
        // $tests = Test::where('')
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $classes = $teacher->classes()->get();
        $subjects = $teacher->subjects;
        $sub_ids = $subjects->pluck('id')->toArray();
        $chapters = Chapter::whereIn('subject_id', $sub_ids)->get();
        $chp_ids = $chapters->pluck('id')->toArray();
        $questions = Question::whereIn('chapter_id', $chp_ids)->get();
        // with the class_id perform AJAX to bring subject and populate subjct dropdown.
        return view('teacher.test.create', compact([
            'classes',
            'subjects',
            'chapters',
            'questions'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $test = Test::create([
            'subject_id' => $request->subject_id,
            'chapter_id' => $request->chapter_id,
            'title' => $request->title,
            'total_marks' => $request->total_marks,
            'duration' => $request->duration,
            'type' => $request->test_type,

        ]);
        $questions = $request->questions;
        foreach($questions as $ques_id) {
            $test_ques = DB::insert('insert into test_question (test_id, question_id) values(?,?)',[$test->id, $ques_id]);
        }
        return redirect(route('teacher.test'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        $chap = Chapter::where('id', $test->chapter_id)->first();
        $sub = $chap->subject;
        $cl = $sub->class;
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $classes = $teacher->classes()->get();
        $subjects = $teacher->subjects;
        $sub_ids = $subjects->pluck('id')->toArray();
        $chapters = Chapter::whereIn('subject_id', $sub_ids)->get();
        $chp_ids = $chapters->pluck('id')->toArray();
        $questions = Question::whereIn('chapter_id', $chp_ids)->get();
        $ques = $test->questions;
        $ques_ids = $ques->pluck('id')->toArray();

        return view('teacher.test.edit', compact([
            'classes',
            'subjects',
            'chapters',
            'questions',
            'test',
            'cl',
            'ques_ids',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        // dd($request);
        $test->update([
            'subject_id' => $request->subject_id,
            'chapter_id' => $request->chapter_id,
            'title' => $request->title,
            'total_marks' => $request->total_marks,
            'duration' => $request->duration,
            'type' => $request->test_type,
        ]);
        $questions = $request->questions;

        $query = DB::table('test_question')->where('test_id', $test->id)->delete();

        if($query) {
            foreach($questions as $ques_id) {
                $test_ques = DB::insert('insert into test_question (test_id, question_id) values(?,?)',[$test->id, $ques_id]);
            }
        }
        return redirect(route('teacher.test'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getQuestions($chp_id, $type) {
        $questions = Question::where('chapter_id', $chp_id)->where('type', $type)->get();
        // dd($subjects);
        return response()->json(array('questions'=> $questions), 200);
    }

    public function getTotalMarks(Request $request) {
        dd("hello");
        dd($request);
        // $questions = Question::where('chapter_id', $chp_id)->where('type', $type)->get();
        // // dd($subjects);
        // return response()->json(array('questions'=> $questions), 200);
    }
}
