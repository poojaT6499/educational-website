<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /* Our Code */

  public function index() {
    $enrollments = Enrollment::all();
    // return view('admin-views.Enrollment.index', compact('Enrollments'));
    return $enrollments;

    // return view('admin.Enrollments', compact([
    //     'Enrollments'
    // ]));
}
public function create()
{
    // will serve add-Enrollment page
    // return view('categories.create');
}

public function store(Request $request)
{
  $enrollment = Enrollment::create([
      'user_id'=>$request->user_id,
      'subject_id'=>$request->subject_id
  ]);

    return $enrollment;
    // session()->flash('success', 'Category Added successfully!');
    // return redirect(route('categories.index'));
}

public function show()
{
    //
}

public function edit()
{
    // will serve edit-Enrollment page (containing update btn)
    // return view('categories.edit', compact([
    //     'category'
    // ]));
}

public function update(Request $request, Enrollment $enrollment)
{   
    $enrollment->user_id = $request->user_id;
    $enrollment->subject_id = $request->subject_id;
    
    $enrollment->update();
}

public function destroy(Enrollment $enrollment)
{
    $enrollment->delete();
    // session()->flash('success', 'Enrollment Deleted Successfully!');
    // return redirect(route('categories.index'));
}

public function restore($id)
{
    // $enrollment = Enrollment::find($id);
    // Enrollment::withTrashed()->$enrollment->restore();

    Enrollment::withTrashed()->find($id)->restore();
    return redirect()->back();
}

/* Our Code Ended */
}
