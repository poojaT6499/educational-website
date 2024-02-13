<?php

namespace App\Http\Controllers\admin;

use App\Models\LiveMeetings;
use App\Models\Course;
use App\Models\Classes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class LiveMeetingsController extends Controller
{
  public function index()
  {
    $data['livemeetings'] = LiveMeetings::leftjoin('classes', 'classes.ClassID', '=', 'livemeetings.classID')->leftjoin('course', 'course.CourseID', '=', 'livemeetings.courseID')->select('livemeetings.*', 'classes.ClassID', 'classes.ClassTitle', 'course.CourseID', 'course.CourseTitle')->orderBy('livemeetings.createdAt', 'desc')->get();
    // dd($data['livemeetings']);
    return view('admin.livemeeting.index', $data);
  }
  public function add()
  {
    $classData = Classes::Where('Status', 1)->get();
    $courseData = Course::Where('Status', 1)->get();
    return view('admin.livemeeting.add', compact('classData', 'courseData'));
  }
  public function addPost()
  {
    $livemeetings_data = array(
      'time' => Request::get('time'),
      'meetingUrl' => Request::get('meetingUrl'),
      'classID' => Request::get('classID'),
      'courseID' => Request::get('courseID'),
      'status' => 1,
    );

    $livemeetings_id = LiveMeetings::insert($livemeetings_data);
    return redirect()->route('livemeetings')->with('message', 'Livemeetings successfully added');
  }
  public function delete($id)
  {
    $livemeetings = LiveMeetings::find($id);
    $livemeetings->delete();
    return redirect()->route('livemeetings')->with('message', 'livemeetings deleted successfully.');
  }
  public function edit($id)
  {
    $classData = Classes::Where('Status', 1)->get();
    $courseData = Course::Where('Status', 1)->get();
    $data['livemeetings'] = LiveMeetings::find($id);
    return view('admin.livemeeting.edit', $data, compact('classData', 'courseData'));
  }
  public function editPost()
  {
    $id = Request::get('meetingID');

    $livemeetings = LiveMeetings::find($id);

    $livemeetings_data = array(
      'time' => Request::get('time'),
      'meetingUrl' => Request::get('meetingUrl'),
      'classID' => Request::get('classID'),
      'courseID' => Request::get('courseID'),
    );
    $livemeetings_id = LiveMeetings::where('meetingID', '=', $id)->update($livemeetings_data);
    return redirect()->route('livemeetings')->with('message', 'livemeetings Updated successfully');
  }


  public function changeStatus($id)
  {
    $livemeetings = LiveMeetings::find($id);
    $livemeetings->status = !$livemeetings->status;
    $livemeetings->save();
    return redirect()->route('livemeetings')->with('message', 'Change livemeetings status successfully');
  }
}
