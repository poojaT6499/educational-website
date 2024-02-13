<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Classes;
use App\Models\DoubtSession;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoubtSessionController extends Controller
{

    /* Our Code */

    public function index() {
        // dd(Auth::user()->id);
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        // dd($teacher);
        $classes = $teacher->classes;
        // $sessions = $teacher->doubtSessions()->get();
        $subjects = $teacher->subjects;
        $sub_ids = $subjects->pluck('id')->toArray();
        $chapters = Chapter::whereIn('subject_id', $sub_ids)->get();
        $chap_ids = $chapters->pluck('id')->toArray();
        $sessions = DoubtSession::whereIn('chapter_id', $chap_ids)->get();
        // dd($sessions);
        // return view('admin-views.DoubtSession.index', compact('DoubtSessions'));
        // return $doubtSessions;
        return view('teacher.session.index', compact([
            'sessions',
            'classes',
            'subjects',
            'chapters'
        ]));
    }
    public function create()
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $classes = $teacher->classes()->get();
        // dd($classes);
        // with the class_id perform AJAX to bring subject and populate subjct dropdown.
        return view('teacher.session.create', compact([
            'classes',
        ]));
    }

    public function store(Request $request)
    {
        // dd($request);
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $doubtSession = DoubtSession::create([
            'teacher_id' => $teacher->id,
            'chapter_id' => $request->chapter_id,
            'title' => $request->title,
            'link' => $request->link,
            'schedule_time' => $request->schedule_date,
            'platform' => NULL,
            'type' => $request->type,
        ]);
        return redirect(route('teacher.session'));
        // return $doubtSession;
        // session()->flash('success', 'Category Added successfully!');
        // return redirect(route('categories.index'));
    }

    public function show()
    {
        //
    }

    public function edit(DoubtSession $session)
    {
        // dd($session);

        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $subjects = $teacher->subjects;
        $sub_ids = $subjects->pluck('id')->toArray();
        $chapters = Chapter::whereIn('subject_id', $sub_ids)->get();

        $chapter = Chapter::where('id', $session->chapter_id)->first();
        $subject = Subject::where('id', $chapter->subject_id)->first();
        $cl = Classes::where('id', $subject->class_id)->first();
        // dd($cl);
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $classes = $teacher->classes()->get();
        return view('teacher.session.edit', compact([
            'classes',
            'cl',
            'subject',
            'chapter',
            'subjects',
            'chapters',
            'session',
        ]));
    }

    public function update(Request $request, DoubtSession $session)//$id)
    {
        // dd($request);
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        // $doubtSession = DoubtSession::find($id);
        $session->teacher_id = $teacher->id;
        $session->chapter_id = $request->chapter_id;
        $session->title = $request->title;
        $session->link = $request->link;
        $session->schedule_time = $request->schedule_date;
        $session->platform = NULL;
        $session->type = $request->type;
        $session->update();

        return redirect(route('teacher.session'));
    }

    public function destroy(DoubtSession $session)
    {
        // $doubtSession = DoubtSession::find($id);
        $session->delete();
        return redirect(route('teacher.session'));
        // session()->flash('success', 'DoubtSession Deleted Successfully!');
        // return redirect(route('categories.index'));
    }

    public function restore($id)
    {
        DoubtSession::withTrashed()->find($id)->restore();
        return redirect()->back();
    }

    public function getSubjects($class_id) {

        $subjects = Subject::where('class_id', $class_id)->get();
        // dd($subjects);
        return response()->json(array('subjects'=> $subjects), 200);
    }

    /* Our Code Ended */

}
