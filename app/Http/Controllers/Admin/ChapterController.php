<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter as Chapter;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Support\Facades\Redirect;
use Hash;

class ChapterController extends Controller
{

  /* Our Code */

  public function index() {
    $Chapters = Chapter::all();
    // return view('admin-views.Chapter.index', compact('Chapters'));
    return $Chapters;

    // return view('admin.Chapters', compact([
    //     'Chapters'
    // ]));
}
public function create()
{
    $classes = Subject::all();
    // will serve add-Chapter page
    // return view('categories.create');
}

public function store(Request $request)
{
  $Chapter = Chapter::create([
      'subject_id'=>$request->subject_id,
      'name'=>$request->name,
      'status'=>$request->status
  ]);

    return $Chapter;
    // session()->flash('success', 'Category Added successfully!');
    // return redirect(route('categories.index'));
}

public function show()
{
    //
}

public function edit()
{
    // will serve edit-Chapter page (containing update btn)
    // return view('categories.edit', compact([
    //     'category'
    // ]));
}

public function update(Request $request, Chapter $chapter)
{   
    $chapter->subject_id = $request->subject_id;
    $chapter->name = $request->name;
    $chapter->status = $request->status;
    
    $chapter->update();
}

public function destroy(Chapter $chapter)
{
    $chapter->delete();
    // session()->flash('success', 'Chapter Deleted Successfully!');
    // return redirect(route('categories.index'));
}

public function restore($id)
{
    Chapter::withTrashed()->find($id)->restore();
    return redirect()->back();
}

/* Our Code Ended */


  /*
  public function index()
  {
    $data['Chapters'] = Chapter::leftjoin('course', 'course.CourseID', '=', 'chapter.CourseID')->select('chapter.*', 'course.CourseID', 'course.CourseTitle')->orderBy('course.CreatedAt', 'desc')->get();
    // dd($data['Chapters']);
    return view('admin.Chapter.index', $data);
  }
  public function add()
  {
    $courseData = Course::Where('Status', 1)->get();
    return view('admin.Chapter.add', compact('courseData'));
  }
  public function addPost()
  {
    $Chapter_data = array(
      'CourseID' => Request::get('CourseID'),
      'VideoUrl' => Request::get('VideoUrl'),
      'IsLiveSession' => Request::get('IsLiveSession'),
      'OrderNo' => Request::get('OrderNo'),
      'Assignments' => '',
      'Status' => 1,
    );


    if (Request::hasFile('Assignments')) {
      $destinationPathh = 'uploads';
      $Assignmentss = Request::file('Assignments');
      $Assignmentss_name = $Assignmentss->getClientOriginalName();
      $Assignmentss->move($destinationPathh, $Assignmentss_name);
      $Chapter_data['Assignments'] = $Assignmentss_name;
    }
    $Chapter_id = Chapter::insert($Chapter_data);
    return redirect()->route('Chapter')->with('message', 'Chapter successfully added');
  }
  public function delete($id)
  {
    $Chapter = Chapter::find($id);
    $Chapter->delete();
    return redirect()->route('Chapter')->with('message', 'Chapter deleted successfully.');
  }
  public function edit($id)
  {
    $data['Chapter'] = Chapter::find($id);
    $courseData = Course::Where('Status', 1)->get();
    return view('admin.Chapter.edit', $data, compact('courseData'));
  }
  public function editPost()
  {
    $id = Request::get('ChapterID');
    $Chapter = Chapter::find($id);

    if (Request::hasFile('Assignments')) {
      $destinationPathh = 'uploads';
      $Assignments = Request::file('Assignments');
      $Assignments_name = $Assignments->getClientOriginalName();
      @unlink($destinationPathh . '/' . $Chapter->Assignments);
      $Assignments->move($destinationPathh, $Assignments_name);
    } else {
      $Assignments_name = $Chapter->Assignment;
    }

    $Chapter_data = array(
      'CourseID' => Request::get('CourseID'),
      'VideoUrl' => Request::get('VideoUrl'),
      'IsLiveSession' => Request::get('IsLiveSession'),
      'OrderNo' => Request::get('OrderNo'),
      'Assignments' => $Assignments_name,
    );
    $Chapter_id = Chapter::where('ChapterID', '=', $id)->update($Chapter_data);
    return redirect()->route('Chapter')->with('message', 'Chapter Updated successfully');
  }


  public function changeStatus($id)
  {
    $Chapter = Chapter::find($id);
    $Chapter->Status = !$Chapter->Status;
    $Chapter->save();
    return redirect()->route('Chapter')->with('message', 'Changed Chapter Status successfully');
  }

  */
}
