<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Notes;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    /* Our Code */

public function create()
{
    $teacher = Auth::user();
    $subjects = $teacher->subjects->get();
    // use AJAX in views for chapter using subject_id
}

public function store(Request $request)
{
  $notes = Notes::create([
      'teacher_id'=>$request->teacher_id,
      'chapter_id'=>$request->chapter_id,
      'file'=>$request->file,
      'type'=>$request->type
  ]);

    return $notes;
    // session()->flash('success', 'Category Added successfully!');
    // return redirect(route('categories.index'));
}

public function show($chapter_id)
{
    $chapter = Chapter::find($chapter_id);
    $notes = $chapter->notes()->get();
}

public function edit()
{
    // will serve edit-Notes page (containing update btn)
    // return view('categories.edit', compact([
    //     'category'
    // ]));
}

public function update(Request $request, $id)
{   
    $notes = Notes::find($id);
    $notes->teacher_id = $request->teacher_id;
    $notes->chapter_id = $request->chapter_id;
    $notes->file = $request->file;
    $notes->type = $request->type;
    
    $notes->update();
}

public function destroy($id)
{
    $notes = Notes::find($id);
    $notes->delete();
    // session()->flash('success', 'Notes Deleted Successfully!');
    // return redirect(route('categories.index'));
}

public function restore($id)
{
    // $notes = Notes::find($id);
    // Notes::withTrashed()->$notes->restore();

    Notes::withTrashed()->find($id)->restore();
    return redirect()->back();
}

/* Our Code Ended */
}
