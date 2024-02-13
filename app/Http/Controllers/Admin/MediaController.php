<?php

namespace App\Http\Controllers\admin;

use App\Models\Media;
use App\Models\Chapter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class MediaController extends Controller
{
  public function index()
  {
    // $data['Media'] = Media::leftjoin('media', 'media.ChapterID', '=', 'chapter.ChapterID')->select('media.*', 'chapter.ChapterID')->orderBy('media.CreatedAt', 'desc')->get();
    $data['Media'] = Media::all();

    return view('admin.media.index', $data);
  }
  public function add()
  {
    $chapterData = Chapter::Where('Status', 1)->get();
    return view('admin.media.add', compact('chapterData'));
  }
  public function addPost()
  {
    $Media_data = array(
      'ChapterID' => Request::get('ChapterID'),
      'MediaType' => Request::get('MediaType'),
      'MediaUrl' => Request::get('MediaUrl'),
      'MediaTitle' => Request::get('MediaTitle'),
      'MediaSubTitle' => Request::get('MediaSubTitle'),
      'Status' => 1,
    );

    $Media_id = Media::insert($Media_data);
    return redirect()->route('Media')->with('message', 'media successfully added');
  }
  public function delete($id)
  {
    $Media = Media::find($id);
    $Media->delete();
    return redirect()->route('Media')->with('message', 'media deleted successfully.');
  }
  public function edit($id)
  {
    $data['media'] = Media::find($id);
    $chapterData = Chapter::Where('Status', 1)->get();
    return view('admin.media.edit', $data, compact('chapterData'));
  }
  public function editPost()
  {
    $id = Request::get('MediaID');

    $Media = Media::find($id);

    $Media_data = array(
      'ChapterID' => Request::get('ChapterID'),
      'MediaType' => Request::get('MediaType'),
      'MediaUrl' => Request::get('MediaUrl'),
      'MediaTitle' => Request::get('MediaTitle'),
      'MediaSubTitle' => Request::get('MediaSubTitle'),
      'Status' => 1,
    );
    $Media_id = Media::where('MediaID', '=', $id)->update($Media_data);
    return redirect()->route('Media')->with('message', 'media Updated successfully');
  }


  public function changeStatus($id)
  {
    $Media = Media::find($id);
    $Media->Status = !$Media->Status;
    $Media->save();
    return redirect()->route('Media')->with('message', 'Change media Status successfully');
  }
}
