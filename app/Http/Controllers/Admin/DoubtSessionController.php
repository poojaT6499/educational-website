<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DoubtSession;
use Illuminate\Http\Request;

class DoubtSessionController extends Controller
{
    /* Our Code */

  public function index() {
    $doubtSessions = DoubtSession::all();
    // return view('admin-views.DoubtSession.index', compact('DoubtSessions'));
    return $doubtSessions;

    // return view('admin.DoubtSessions', compact([
    //     'DoubtSessions'
    // ]));
}
public function create()
{
    // $teachers = Teacher::all();
    // from this teacher object u can get subject id via chapter_id for views
}

public function store(Request $request)
{
  $doubtSession = DoubtSession::create([
      'teacher_id'=>$request->teacher_id,
      'chapter_id'=>$request->chapter_id,
      'title'=>$request->title,
      'link'=>$request->link,
      'schedule_time'=>$request->schedule_time,
      'platform'=>$request->platform
  ]);

    return $doubtSession;
    // session()->flash('success', 'Category Added successfully!');
    // return redirect(route('categories.index'));
}

public function show()
{
    //
}

public function edit()
{
    // will serve edit-DoubtSession page (containing update btn)
    // return view('categories.edit', compact([
    //     'category'
    // ]));
}

public function update(Request $request, DoubtSession $doubtSession)//$id)
{   
    // $doubtSession = DoubtSession::find($id);
    $doubtSession->teacher_id = $request->teacher_id;
    $doubtSession->chapter_id = $request->chapter_id;
    $doubtSession->title = $request->title;
    $doubtSession->link = $request->link;
    $doubtSession->schedule_time = $request->schedule_time;
    $doubtSession->platform = $request->platform;
    
    $doubtSession->update();
}

public function destroy($id)
{
    $doubtSession = DoubtSession::find($id);
    $doubtSession->delete();
    // session()->flash('success', 'DoubtSession Deleted Successfully!');
    // return redirect(route('categories.index'));
}

public function restore($id)
{
    DoubtSession::withTrashed()->find($id)->restore();
    return redirect()->back();
}

/* Our Code Ended */
}
