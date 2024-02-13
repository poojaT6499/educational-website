<?php

namespace App\Http\Controllers\teacher;

use App\Models\Media;
use App\Models\Chapter;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Support\Facades\Request;

class MediaController extends Controller
{

  /* Our Code */

  public function index() {
    $teacher = Teacher::find(1);//Auth::user();
    $subjects = $teacher->subjects()->with('chapters')->get();
   
    // below showing another way that how to access in views 
    /*
    foreach($subjects as $subject)
    {
      echo $subject->chapters()->with('media')->get();
    }
    */

    return $subjects;

    // return view('admin.Chapters', compact([
    //     'Chapters'
    // ]));
}
public function create()
{
  $teacher = Teacher::find(1);//Auth::user();
  $subjects = $teacher->subjects()->get();
  // will serve add-Chapter page with subjects dropdown and chapter using AJAX function in TeacherController
  // return view('media.create');
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


  // public function index()
  // {
  //   // $data['Media'] = Media::leftjoin('media', 'media.ChapterID', '=', 'chapter.ChapterID')->select('media.*', 'chapter.ChapterID')->orderBy('media.CreatedAt', 'desc')->get();
  //   $data['Media'] = Media::all();

  //   return view('admin.media.index', $data);
  // }
  // public function add()
  // {
  //   $chapterData = Chapter::Where('Status', 1)->get();
  //   return view('admin.media.add', compact('chapterData'));
  // }
  // public function addPost()
  // {
  //   $Media_data = array(
  //     'ChapterID' => Request::get('ChapterID'),
  //     'MediaType' => Request::get('MediaType'),
  //     'MediaUrl' => Request::get('MediaUrl'),
  //     'MediaTitle' => Request::get('MediaTitle'),
  //     'MediaSubTitle' => Request::get('MediaSubTitle'),
  //     'Status' => 1,
  //   );

  //   $Media_id = Media::insert($Media_data);
  //   return redirect()->route('Media')->with('message', 'media successfully added');
  // }
  // public function delete($id)
  // {
  //   $Media = Media::find($id);
  //   $Media->delete();
  //   return redirect()->route('Media')->with('message', 'media deleted successfully.');
  // }
  // public function edit($id)
  // {
  //   $data['media'] = Media::find($id);
  //   $chapterData = Chapter::Where('Status', 1)->get();
  //   return view('admin.media.edit', $data, compact('chapterData'));
  // }
  // public function editPost()
  // {
  //   $id = Request::get('MediaID');

  //   $Media = Media::find($id);

  //   $Media_data = array(
  //     'ChapterID' => Request::get('ChapterID'),
  //     'MediaType' => Request::get('MediaType'),
  //     'MediaUrl' => Request::get('MediaUrl'),
  //     'MediaTitle' => Request::get('MediaTitle'),
  //     'MediaSubTitle' => Request::get('MediaSubTitle'),
  //     'Status' => 1,
  //   );
  //   $Media_id = Media::where('MediaID', '=', $id)->update($Media_data);
  //   return redirect()->route('Media')->with('message', 'media Updated successfully');
  // }


  // public function changeStatus($id)
  // {
  //   $Media = Media::find($id);
  //   $Media->Status = !$Media->Status;
  //   $Media->save();
  //   return redirect()->route('Media')->with('message', 'Change media Status successfully');
  // }
}
