<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\McqSubmission;
use Illuminate\Http\Request;

class McqSubmissionController extends Controller
{
    /* Our Code */

  public function index() {
    $mcqSubmissions = McqSubmission::all();
    // return view('admin-views.McqSubmission.index', compact('McqSubmissions'));
    return $mcqSubmissions;

    // return view('admin.McqSubmissions', compact([
    //     'McqSubmissions'
    // ]));
  }

    public function destroy(McqSubmission $mcqSubmission)
    {
        $mcqSubmission->delete();
        // session()->flash('success', 'McqSubmission Deleted Successfully!');
        // return redirect(route('categories.index'));
    }

    public function restore($id)
    {
        // $mcqSubmission = McqSubmission::find($id);
        // McqSubmission::withTrashed()->$mcqSubmission->restore();

        McqSubmission::withTrashed()->find($id)->restore();
        return redirect()->back();
    }
    /* Our Code ENDED*/
}
