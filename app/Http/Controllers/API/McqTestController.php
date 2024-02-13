<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\McqResults;
use App\Models\McqSubmission;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;

class McqTestController extends Controller
{
    public function index($user_id)
    {
        $user = User::find($user_id);

        $results = $user->mcqResult()->with('test')->get();

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

            $mcqSubmissions = McqSubmission::where('user_id', $user_id)->where('test_id', $result->test_id)->get();

            foreach($mcqSubmissions as $submission)
            {
                $is_correct = Option::findOrFail($submission->option_id)->is_correct;

                $question_marks = Question::findOrFail($submission->question_id)->marks;
                if($is_correct == 1)
                {
                    $correct++;
                    $totalMarksObtained += $question_marks;
                }
                else if($is_correct == 0)
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
        // return json_encode($data);
        return response()->json($data);

        // dd("Correct= ".$correct ."     incorrect= ".$incorrect ."      Total= ".$totalMarksObtained);

    }

    public function store(Request $request)
    {
        $questionsInfo = json_decode($request->data);
        $queries = array();
        $i=0;
        $user_id = "";
        $test_id = "";
        foreach($questionsInfo as $questionInfo)
        {
            $user_id = $questionInfo->userID;
            $test_id = $questionInfo->testID;
            // dd($questionInfo);//->testID); // we want class ID in obj
            if($questionInfo->optionID === null || $questionInfo->optionID === "")
            {
                $questionInfo->optionID = null;
            }
            $query = McqSubmission::create([
                'user_id' => $questionInfo->userID,
                'class_id' => $questionInfo->classID,
                'test_id' => $questionInfo->testID,
                'question_id' => $questionInfo->questionID,
                'option_id' => $questionInfo->optionID,
            ]);
            $queries[$i] = $query;
            $i++;
        }

        // calculating result and storing in McqResult Table
        $mcqSubmissions = McqSubmission::where('user_id', $user_id)->where('test_id', $test_id)->get();
        
        $totalMarksObtained = 0;
        foreach($mcqSubmissions as $submission)
        {
            if(! $submission->option_id === null || $submission->option_id === "")
            {
                $is_correct = Option::findOrFail($submission->option_id)->is_correct;

                $question_marks = Question::findOrFail($submission->question_id)->marks;
                if($is_correct == 1)
                {
                    $totalMarksObtained += $question_marks;
                }
            }
        }
        McqResults::create([
            'user_id' => $user_id,
            'test_id' => $test_id,
            'marks_obtained' => $totalMarksObtained
        ]);
        
        return response()->json(
            [
              'message' => 'success',
              'data' => $queries
            ],
        );
    }
}

