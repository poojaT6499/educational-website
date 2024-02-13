<?php

namespace App\Http\Controllers\admin;

use App\Models\Course;
use App\Models\Classes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class CourseController extends Controller
{
  public function index()
  {
    $data['Course'] = Course::leftjoin('classes', 'classes.ClassID', '=', 'course.ClassID')->select('course.*',  'classes.*')->orderBy('course.CreatedAt', 'desc')->get();

    return view('admin.Course.index', $data);
  }
  public function add()
  {
    $classData = Classes::Where('Status', 1)->get();
    return view('admin.Course.add', compact('classData'));
  }
  public function addPost()
  {
    $Course_data = array(
      'ClassID' => Request::get('ClassID'),
      'CourseTitle' => Request::get('CourseTitle'),
      'ChapterNos' => Request::get('ChapterNos'),
      'TotalTime' => Request::get('TotalTime'),
      'Status' => 1,
    );

    $Course_id = Course::insert($Course_data);
    return redirect()->route('Course')->with('message', 'Course successfully added');
  }
  public function delete($id)
  {
    $Course = Course::find($id);
    $Course->delete();
    return redirect()->route('Course')->with('message', 'Course deleted successfully.');
  }
  public function edit($id)
  {
    $data['Course'] = Course::find($id);
    $classData = Classes::Where('Status', 1)->get();
    return view('admin.Course.edit', $data, compact('classData'));
  }
  public function editPost()
  {
    $id = Request::get('CourseID');

    $Course = Course::find($id);

    $Course_data = array(
      'ClassID' => Request::get('ClassID'),
      'CourseTitle' => Request::get('CourseTitle'),
      'ChapterNos' => Request::get('ChapterNos'),
      'TotalTime' => Request::get('TotalTime'),
    );
    $Course_id = Course::where('CourseID', '=', $id)->update($Course_data);
    return redirect()->route('Course')->with('message', 'Course Updated successfully');
  }


  public function changeStatus($id)
  {
    $Course = Course::find($id);
    $Course->Status = !$Course->Status;
    $Course->save();
    return redirect()->route('Course')->with('message', 'Change Course Status successfully');
  }
}
