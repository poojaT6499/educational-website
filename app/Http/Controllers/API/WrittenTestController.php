<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Test;
use App\Models\User;
use App\Models\WrittenSubmission;
use Illuminate\Http\Request;

class WrittenTestController extends Controller
{
    public function index($user_id)
    {
        $user = User::find($user_id);
        // return($user->writtenResult()->with('test')->get());
        $results = $user->writtenResult()->with('test')->get();
        $idx = 0;
        $data = array();
        foreach($results as $result)
        {
            $test = Test::findOrFail($result->test_id);
            $chapter = Chapter::findOrFail($test->chapter_id);
            $subject = $chapter->subject()->get()[0];
            $questions = $test->questions()->get();
            $questionsCount = $test->questions()->count();

            $totalMarksOfTest = $test->total_marks;

            $correct = 0;
            $incorrect = 0;
            $totalMarksObtained = 0;

            $writtenSubmissions = WrittenSubmission::where('user_id', $user_id)->where('test_id', $result->test_id)->get();

            foreach($writtenSubmissions as $submission)
            {
                if($submission->marks_obtained > 0)
                {
                    $totalMarksObtained += $submission->marks_obtained;
                    $correct++;
                }
                else if($submission->marks_obtained == 0)
                {
                    $incorrect++;
                }
            }

            $data["data"][$idx]["user"] = $user;
            // $data["data"][$idx]["result"] = $result;
            $data["data"][$idx]["test"] = $test;
            $data["data"][$idx]["chapter"] = $chapter;
            $data["data"][$idx]["subject"] = $subject;
            $data["data"][$idx]["questionsCount"] = $questionsCount;
            $data["data"][$idx]["totalMarksOfTest"] = $totalMarksOfTest;
            $data["data"][$idx]["correct"] = $correct;
            $data["data"][$idx]["incorrect"] = $incorrect;
            $data["data"][$idx]["totalMarksObtained"] = $totalMarksObtained;

            $idx++;

        }
        // dd($data);
        if(sizeof($data) == 0)
            $data["data"] = $data;

        return response()->json($data);

        // return json_encode($data);

        // dd("Correct= ".$correct ."     incorrect= ".$incorrect ."      Total= ".$totalMarksObtained);
        // $data = [];

        // $data["user"] = $user;
        // // $data["result"] = $result;
        // $data["test"] = $test;
        // $data["chapter"] = $chapter;
        // $data["subject"] = $subject;
        // $data["questionsCount"] = $questionsCount;
        // $data["totalMarksOfTest"] = $totalMarksOfTest;
        // $data["correct"] = $correct;
        // $data["incorrect"] = $incorrect;
        // $data["totalMarksObtained"] = $totalMarksObtained;

        // return json_encode($data);
    }

    public function store(Request $request)
    {
        dd($request);
        // $query = Classes::create([
        //     'name' => $payload['name'],
        //     'status' => $payload['status'],
        //     'deleted_at' => $payload['deleted_at'],
        //     'created_at' => $payload['created_at'],
        //     'updated_at' => $payload['updated_at'],
        // ]);

        // return response()->json(
        //     [
        //       'message' => 'success',
        //       'data' => $query
        //     ],
        // );
    }
}

