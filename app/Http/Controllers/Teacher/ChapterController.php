<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Classes;
use App\Models\Media;
use App\Models\Notes;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChapterController extends Controller
{
    public function index() {
        $teacher = Teacher::find(Auth::user()->id);//Auth::user();
        // $subjects = $teacher->subjects()->with('chapters')->get();

        // below showing another way that how to access in views
        /*
        $subjects = $teacher->subjects()->get();
        foreach($subjects as $subject)
        {
        echo $subject->chapters()->get();
        }
        */
        // return $subjects;

        // return view('admin.Chapters', compact([
        //     'Chapters'
        // ]));

        $classes = Classes::all();
        $subjects = Subject::all();
        $chapters = Chapter::all();
        return view('teacher.chapter.index', compact([
            'classes',
            'subjects',
            'chapters'
        ]));
    }

    public function create($class_id, $subject_id)
    {
        // will serve add-Subject page
        $class = Classes::where('id', $class_id)->first();
        $subject = Subject::where('id', $subject_id)->first();
        // dd($class);
        return view('teacher.chapter.create', compact([
            'class',
            'subject'
        ]));
    }

    // public function create()
    // {
    //     // dd("Hello");
    //     $teacher = Teacher::find(1);//Auth::user();
    //     $subjects = $teacher->subjects()->get();
    //     return view('teacher.chapter.create');
    //     // will serve add-Chapter page with subjects dropdown
    //     // return view('categories.create');
    // }

    public function store(Request $request)
    {
        // dd($request);
        $teacher = Teacher::find(Auth::user()->id);

        $chapter = Chapter::create([
            'subject_id' => $request->subject_id,
            'name' => $request->name,
            'status' => 0
        ]);

        if ($request->hasfile('video')) {
            $file = $request->file('video');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('assets/admin/media/chapters/videos', $filename);
            $video = $filename;
        } else {
            $video = '';
        }

        if($request->exists('is_demo'))
            $is_demo = $request->is_demo == "on" ? 1 : 0;
        else
            $is_demo = 0;

        $media = Media::create([
            'subject_id' => $request->subject_id,
            'chapter_id' => $chapter->id,
            'media_type' => $extension,
            'media_url' => config('app.url') . "/assets/admin/media/chapters/videos/".$video,
            'title' => $request->media_title,
            'is_demo' => $is_demo,
        ]);

        $notes = $request->file('notes');
        $i = 0;
        if ($request->hasfile('notes')) {
            foreach($notes as $note) {
                // dd($notes[1]);
                $extension = $note->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                $note->move('assets/admin/media/chapters/notes', $filename);
                $files[$i] = $filename;
                // dd($filename);

                $note = Notes::create([
                    'teacher_id' => $teacher->id,
                    'chapter_id' => $chapter->id,
                    'file' => config('app.url') . "/assets/admin/media/chapters/notes/".$filename,
                    'type' => $extension,
                ]);

                $i++;
            }
        }

        $class = Classes::find($request->class_id);
        $subject = Subject::find($request->subject_id);
        $chapters = Chapter::where('subject_id', $request->subject_id)->get();
        $medias = Media::where('subject_id', $request->subject_id)->get();
        // dd($subject);
        return view('teacher.subject.chapter', compact([
            'class',
            'subject',
            'chapters',
            'medias'
        ]));

        // return $chapter;
        // session()->flash('success', 'Category Added successfully!');
        // return redirect(route('categories.index'));
    }

    public function show()
    {
        //
    }

    public function edit($class, $subject, $chapter_id)
    {
        // will serve edit-Chapter page (containing update btn)
        // return view('categories.edit', compact([
        //     'category'
        // ]));
        $class = Classes::where('id', $class)->first();
        $subject = Subject::where('id', $subject)->first();
        $chapter = Chapter::where('id', $chapter_id)->first();
        $media = Media::where('chapter_id', $chapter_id)->first();
        $notes = Notes::where('chapter_id', $chapter_id)->get();
        // dd($media->title);
        return view('teacher.chapter.edit', compact([
            'class',
            'subject',
            'chapter',
            'media',
            'notes'
        ]));
    }

    public function update(Request $request, Chapter $chapter)
    {
        // dd($request);

        $teacher = Teacher::find(Auth::user()->id);

        $chapter->update([
            'subject_id' => $request->subject_id,
            'name' => $request->name,
            'status' => 0
        ]);

        $media = Media::where('chapter_id', $chapter->id)->first();

        if ($request->hasfile('video')) {
            $video = $media->deleteVideo();
            $file = $request->file('video');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('assets/admin/media/chapters/videos', $filename);
            $video = config('app.url') . "assets/admin/media/chapters/videos/" . $filename;
        } else {
            $video = $media ? $media->media_url : '';
            $extension = $media ? $media->media_type : '';
        }

        if($request->exists('is_demo'))
            $is_demo = $request->is_demo == "on" ? 1 : 0;
        else
            $is_demo = 0;

        if($media) {
            $media->update([
                'subject_id' => $request->subject_id,
                'chapter_id' => $chapter->id,
                'media_type' => $extension,
                'media_url' => $video,
                'title' => $request->media_title,
                'is_demo' => $is_demo,
            ]);
        }


        $notes = $request->file('notes');
        $i = 0;
        if ($request->hasfile('notes')) {
            foreach($notes as $note) {
                // dd($notes[1]);
                $extension = $note->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                $note->move('assets/admin/media/chapters/notes', $filename);
                $files[$i] = $filename;
                $note->update([
                    'teacher_id' => $teacher->id,
                    'chapter_id' => $chapter->id,
                    'file' => config('app.url') . "assets/admin/media/chapters/notes/".$filename,
                    'type' => $extension,
                ]);
                $i++;
            }
        }

        $class = Classes::find($request->class_id);
        $subject = Subject::find($request->subject_id);
        $chapters = Chapter::where('subject_id', $request->subject_id)->get();
        $medias = Media::where('subject_id', $request->subject_id)->get();
        return redirect(route('teacher.subject.chapter', [$request->class_id, $request->subject_id]));
    }

    public function destroy(Chapter $chapter)
    {
        dd($chapter);
        $chapter->delete();
    }

    public function restore($id)
    {
        Chapter::withTrashed()->find($id)->restore();
        return redirect()->back();
    }


    public function subjectWiseChapters($class_id, $subject_id)
    {
        // dd($subject_id);
        $class = Classes::find($class_id);
        $subject = Subject::find($subject_id);
        $chapters = Chapter::where('subject_id', $subject_id)->get();
        $medias = Media::where('subject_id', $subject_id)->get();
        // dd($subject);
        return view('teacher.chapter.index', compact([
            'class',
            'subject',
            'chapters',
            'medias'
        ]));
    }

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
