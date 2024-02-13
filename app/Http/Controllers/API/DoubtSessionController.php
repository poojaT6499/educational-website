<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoubtSessionResource;
use App\Models\Chapter;
use App\Models\DoubtSession;
use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoubtSessionController extends Controller
{
    public function index($user_id)
    {
        $user = User::find($user_id);
        $enrollments = $user->enrollments()->get();
        // dd($enrollments);
        // if user is not enrolled in any of teh subject
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

        // return($allChapters);
        $i = 0;

        foreach($allChapters as $chps)
        {
            $chapt = Chapter::findOrFail($chps["id"])->doubtSessions()->where('type', 0)->get();

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

        // dd($doubtSessions[0]["teacher"]->name);
        // $jsonobj = json_encode($doubtSessions);
        // return json_encode($doubtSessions);

        return response()->json([
            "data" => $doubtSessions
        ]);

        // return new DoubtSessionResource($jsonobj);
        // return $doubtSessions; // DoubtSessionResource
    }

}

