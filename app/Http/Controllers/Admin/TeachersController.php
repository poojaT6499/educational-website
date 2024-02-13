<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = User::where('role', '1')->get();
        return view('admin.teacher.index', compact([
            'teachers',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('admin.teacher.create', compact([
            'classes',
            'subjects'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 1,
        ]);

        $teacher = Teacher::create([
            'user_id' => $user->id,
        ]);


        // return $class;
        session()->flash('success', 'Teacher Added Successfully!');
        return redirect(route('admin.teacher'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $teacher)
    {
        $realTeacher = Teacher::where('user_id', $teacher->id)->first();
        // dd($realTeacher->classes);
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('admin.teacher.show', compact([
            'classes',
            'subjects',
            'teacher',
            'realTeacher',
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $teacher)
    {
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('admin.teacher.edit', compact([
            'classes',
            'subjects',
            'teacher',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $teacher)
    {
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 1,
        ]);

        // return $class;
        session()->flash('success', 'Teacher Updated Successfully!');
        return redirect(route('admin.teacher'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $teacher)
    {
        $teacher->delete();
        session()->flash('success', 'Teacher Deleted Successfully!');
        return redirect(route('admin.teacher'));
    }
}
