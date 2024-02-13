<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notes;
use App\Models\Teacher;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /* Our Code */

  public function index() {
    $notes = Notes::all();
    // return view('admin-views.Notes.index', compact('Notess'));
    return $notes;

    // return view('admin.Notess', compact([
    //     'Notess'
    // ]));
}
public function create()
{
    $teachers = Teacher::all();
    // from this teacher object u can get subject id via chapter_id for views
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

public function show()
{
    //
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
