<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /* Our Code */

  public function index() {
    $test = Test::all();
    // return view('admin-views.Test.index', compact('Tests'));
    return $test;

    // return view('admin.Tests', compact([
    //     'Tests'
    // ]));
}
public function create()
{
    $subjects = Subject::all();
    $chapters = Subject::all();
}

public function store(Request $request)
{
  $test = Test::create([
      'subject_id'=>$request->subject_id,
      'chapter_id'=>$request->chapter_id,
      'title'=>$request->title,
      'total_marks'=>$request->total_marks,
      'duration'=>$request->duration
  ]);

    return $test;
    // session()->flash('success', 'Category Added successfully!');
    // return redirect(route('categories.index'));
}

public function show()
{
    //
}

public function edit()
{
    // will serve edit-Test page (containing update btn)
    // return view('categories.edit', compact([
    //     'category'
    // ]));
}

public function update(Request $request, Test $test)//$id)
{   
    // $test = Test::find($id);
    $test->subject_id = $request->subject_id;
    $test->chapter_id = $request->chapter_id;
    $test->title = $request->title;
    $test->total_marks = $request->total_marks;
    $test->duration = $request->duration;
    
    $test->update();
}

public function destroy(Test $test)
{
    // $test = Test::find($id);
    $test->delete();
    // session()->flash('success', 'Test Deleted Successfully!');
    // return redirect(route('categories.index'));
}

public function restore($id)
{
    // $test = Test::find($id);
    // Test::withTrashed()->$test->restore();

    Test::withTrashed()->find($id)->restore();
    return redirect()->back();
}

/* Our Code Ended */
}
