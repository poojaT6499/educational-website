<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->user_id);
        $teacher = Teacher::where('user_id', $request->user_id)->first();
        $teacherClass = DB::table('teacher_class')->insert([
            'teacher_id' => $teacher->id,
            'classes_id' => $request->class_id,
        ]);
        $teacherSubject = DB::table('teacher_subject')->insert([
            'teacher_id' => $teacher->id,
            'subject_id' => $request->subject_id,
        ]);
        session()->flash('success', 'Subject Assigned Successfully!');
        return redirect(route('admin.teacher.show', $request->user_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $teacher)
    {
        // dd($request->user_id);
        // $teacher = Teacher::where('user_id', $request->user_id)->first();
        // $teacherClass = DB::table('teacher_class')->insert([
        //     'teacher_id' => $teacher->id,
        //     'classes_id' => $request->class_id,
        // ]);
        // $teacherSubject = DB::table('teacher_subject')->insert([
        //     'teacher_id' => $teacher->id,
        //     'subject_id' => $request->subject_id,
        // ]);
        // session()->flash('success', 'Subject Assigned Successfully!');
        // return redirect(route('admin.teacher.show', $request->user_id));
    }
}
