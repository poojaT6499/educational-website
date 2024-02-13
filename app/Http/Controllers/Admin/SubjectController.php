<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{

    public function index() {
        if(Auth::user()->isAdmin()) {
            $subjects = Subject::all();
            $classes = Classes::all();
            // return $subjects;
            return view('admin.subject.index', compact([
                'subjects',
                'classes'
            ]));
        } elseif(Auth::user()->isTeacher()) {
            $teacher = Teacher::where('user_id', Auth::user()->id)->first();
            // dd($teacher);
            $subjects = $teacher->subjects;
            // dd($teacher->classes);
            $classes = $teacher->classes;
            $classes_ids = DB::table('teacher_class')->where('teacher_id', $teacher->id)->select('classes_id')->distinct()->get()->toArray();
            // dd($classes_ids);
            $class_ids = [];
            $i =0;
            foreach($classes_ids as $id) {
                $class_ids[$i++] = $id->classes_id;
            }
            // dd($class_ids);
            $classes = Classes::whereIn('id', $class_ids)->get();
            // dd($classes);
            return view('teacher.subject.index', compact([
                'subjects',
                'classes'
            ]));
        } else {
            abort(401);
        }
    }

    public function create($class_id, $subject_id)
    {
        // will serve add-Subject page
        $class = Classes::where('id', $class_id)->get();
        $subject = Subject::where('id', $subject_id)->get();
        dd($class);
        return view('admin.subject.create', compact([
            'class',
            'subject'
        ]));
    }

    public function store(Request $request)
    {
        if($request->exists('status'))
            $status = $request->status == "on" ? 1 : 0;
        else
            $status = 0;

        $subject = Subject::create([
            'class_id' => $request->class_id,
            'name' => $request->name,
            'status' => $status
        ]);

        // return $subject;
        session()->flash('success', 'Subject Added Successfully!');
        return redirect(route('admin.subject'));
    }

    public function show()
    {
        //
    }

    public function edit(Subject $subject)
    {
        // will serve edit-Subject page (containing update btn)
        $classes = Classes::all();
        return view('admin.subject.edit', compact([
            'classes',
            'subject'
        ]));
    }

    public function update(Request $request, Subject $subject)
    {
        if($request->exists('status'))
            $status = $request->status == "on" ? 1 : 0;
        else
            $status = 0;

        $subject->update([
            'class_id' => $request->class_id,
            'name' => $request->name,
            'status' => $status
        ]);

        session()->flash('success', 'Subject Updated Successfully!');
        return redirect(route('admin.subject'));
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        session()->flash('success', 'Subject Deleted Successfully!');
        return redirect(route('admin.subject'));
    }

    public function restore($id)
    {
        Subject::withTrashed()->find($id)->restore();
        return redirect()->back();
    }

}
