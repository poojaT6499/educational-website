<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\WrittenResults;
use App\Models\WrittenResultss;
use Illuminate\Http\Request;

class WrittenResultsController extends Controller
{
    /* Our Code */

  public function index() {
    $writtenResult = WrittenResults::all();
    // return view('admin-views.WrittenResults.index', compact('WrittenResultss'));
    return $writtenResult;

    // return view('admin.WrittenResultss', compact([
    //     'WrittenResultss'
    // ]));
}

    public function destroy(WrittenResults $writtenResult)
    {
        $writtenResult->delete();
        // session()->flash('success', 'WrittenResults Deleted Successfully!');
        // return redirect(route('categories.index'));
    }

    public function restore($id)
    {
        // $writtenResult = WrittenResults::find($id);
        // WrittenResults::withTrashed()->$writtenResult->restore();

        WrittenResults::withTrashed()->find($id)->restore();
        return redirect()->back();
    }
    /* Our Code ENDED */
}
