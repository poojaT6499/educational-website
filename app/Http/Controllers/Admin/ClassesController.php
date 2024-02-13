<?php

namespace App\Http\Controllers\admin;

use App\Models\Classes as Classes;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ClassesController extends Controller
{

    public function index() {
        $classes = Classes::all();
        // return $classes;
        return view('admin.classes.index', compact([
            'classes'
        ]));
    }

    public function create()
    {
        // will serve add-Classes page
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        if($request->exists('status'))
            $status = $request->status == "on" ? 1 : 0;
        else
            $status = 0;

        $class = Classes::create([
            'name' => $request->name,
            'status' => $status,
        ]);

        // return $class;
        session()->flash('success', 'Classes Added Successfully!');
        return redirect(route('admin.classes'));
    }

    public function show()
    {
        //
    }

    public function edit(Classes $class)
    {
        // will serve edit-Classes page (containing update btn)
        return view('admin.classes.edit', compact([
            'class'
        ]));
    }

    public function update(Request $request, Classes $class)
    {
        if($request->exists('status'))
            $status = $request->status == "on" ? 1 : 0;
        else
            $status = 0;

        $class->update([
            'name' => $request->name,
            'status' => $status,
        ]);

        session()->flash('success', 'Classes Updated Successfully!');
        return redirect(route('admin.classes'));
    }

    public function destroy(Classes $class)
    {
        $class->delete();
        session()->flash('success', 'Classes Deleted Successfully!');
        return redirect(route('admin.classes'));
    }

    public function restore($id)
    {
        Classes::withTrashed()->find($id)->restore();
        return redirect()->back();
    }


    public function getSubjects($class_id) {

        $subjects = Subject::where('class_id', $class_id)->get();
        // dd($subjects);
        return response()->json(array('subjects'=> $subjects), 200);
    }

}
