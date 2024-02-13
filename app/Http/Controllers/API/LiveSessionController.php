<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\DoubtSession;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class LiveSessionController extends Controller
{
    public function index($user_id)
    {
        $user = User::find($user_id);
        $enrollments = $user->enrollments()->get();

        if(sizeof($enrollments) == 0){
            return response()->json([
                "data" => $enrollments
            ]); 
        }

        foreach($enrollments as $enrollment)
        {
            $chapters[] = Subject::findOrFail($enrollment->subject_id)->chapters()->get();
        }

        // dd($chapters);

        $idx = 0;
        foreach($chapters as $chapter)
        {
            if(sizeof($chapter) > 1)
            {
                foreach($chapter as $c)
                {
                    $allChapters[$idx] = $c->toArray();
                    $idx++;
                }
            } else if(sizeof($chapter) == 1){
                $allChapters[$idx] = $chapter->toArray()[0];
                $idx++;
            }
        }

        // dd($allChapters);
        $i = 0;
        // $doubtSessions = array();
        foreach($allChapters as $chps)
        {
            $chapt = Chapter::findOrFail($chps["id"])->doubtSessions()->where('type', 1)->get();
            
            if(sizeof($chapt)> 1)
            {
                foreach($chapt as $c)
                {
                    $doubtSessions[$i] = $c->toArray();
                    $i++;
                }
            }
            else if(sizeof($chapt) == 1)
            {
                $doubtSessions[$i] = $chapt->toArray()[0];
                $i++;
            }
        }


        $x = 0;
        for($x; $x < sizeof($doubtSessions); $x++)
        {
            $teacher = Teacher::findOrFail($doubtSessions[$x]["teacher_id"]);
            $userObj = User::findOrFail($teacher->user_id);

            $doubtSessions[$x]["teacher"] = $userObj;

            $subjectObj = Chapter::findOrFail($doubtSessions[$x]["chapter_id"])->subject()->get();

            $doubtSessions[$x]["subject"] = $subjectObj;
        }

        // return json_encode($doubtSessions);
        return response()->json([
            "data" => $doubtSessions
        ]);

        // return $doubtSessions;
    }
}

