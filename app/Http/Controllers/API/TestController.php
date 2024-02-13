<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestsResource;
use App\Models\Subject;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{

    // public function index()
    // {
    //     return BannersResource::collection(Banner::all());
    // }

    public function index($subj_id, $chapt_id)
    {
        return TestsResource::collection(Test::where("subject_id", $subj_id)->where("chapter_id", $chapt_id)->get());
    }

    public function show($id)
    {
        // dd(Test::findOrFail($id)->questions()->with('options')->get());
        // return TestsResource::collection(Test::findOrFail($id)->questions()->with('options')->get());
        $test = Test::findOrFail($id);
        $questions = $test->questions()->with('options')->get();

        $data["data"]["test_details"] = $test;
        $data["data"]["questions"] = $questions;

        // return json_encode($data);
        return response()->json($data);

    }

    public function testsBySubject($subject_id)
    {
        return TestsResource::collection(Subject::findOrFail($subject_id)->tests()->get());
    }


}
