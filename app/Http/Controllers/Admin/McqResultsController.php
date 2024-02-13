<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\McqResults;
use Illuminate\Http\Request;

class McqResultsController extends Controller
{
    /* Our Code */

  public function index() {
    $mcqResults = McqResults::all();
    // return view('admin-views.McqResults.index', compact('McqResultss'));
    return $mcqResults;

    // return view('admin.McqResultss', compact([
    //     'McqResultss'
    // ]));
  }

    public function destroy($id)
    {
        $mcqResults = McqResults::find($id);
        $mcqResults->delete();
        // session()->flash('success', 'McqResults Deleted Successfully!');
        // return redirect(route('categories.index'));
    }

    public function restore($id)
    {
        // $mcqResults = McqResults::find($id);
        // McqResults::withTrashed()->$mcqResults->restore();

        McqResults::withTrashed()->find($id)->restore();
        return redirect()->back();
    }
    /* Our Code ENDED*/
}
