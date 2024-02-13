<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\WrittenSubmission;
use Illuminate\Http\Request;

class WrittenSubmissionController extends Controller
{
    /* Our Code */

  public function index() {
    $writtenSubmissions = WrittenSubmission::all();
    // return view('admin-views.WrittenSubmission.index', compact('WrittenSubmissions'));
    return $writtenSubmissions;

    // return view('admin.WrittenSubmissions', compact([
    //     'WrittenSubmissions'
    // ]));
}

public function destroy(WrittenSubmission $writtenSubmission)
{
    $writtenSubmission->delete();
    // session()->flash('success', 'WrittenSubmission Deleted Successfully!');
    // return redirect(route('categories.index'));
}

public function restore($id)
{
    // $writtenSubmission = WrittenSubmission::find($id);
    // WrittenSubmission::withTrashed()->$writtenSubmission->restore();

    WrittenSubmission::withTrashed()->find($id)->restore();
    return redirect()->back();
}


// public function create()
// {
    
// }

// public function store(Request $request)
// {
//   $writtenSubmission = WrittenSubmission::create([
//       'user_id'=>$request->user_id,
//       'subject_id'=>$request->subject_id
//   ]);

//     return $writtenSubmission;
//     // session()->flash('success', 'Category Added successfully!');
//     // return redirect(route('categories.index'));
// }

// public function show()
// {
//     //
// }

// public function edit()
// {
//     // will serve edit-WrittenSubmission page (containing update btn)
//     // return view('categories.edit', compact([
//     //     'category'
//     // ]));
// }

// public function update(Request $request, WrittenSubmission $writtenSubmission)
// {   
//     $writtenSubmission->user_id = $request->user_id;
//     $writtenSubmission->subject_id = $request->subject_id;
    
//     $writtenSubmission->update();
// }



/* Our Code Ended */
}
