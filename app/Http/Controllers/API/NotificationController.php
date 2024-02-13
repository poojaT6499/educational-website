<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index($user_id)
    {
        $user = User::find($user_id);
        $enrollments = $user->enrollments()->get();
        $enrolls = [];
        $i=0;

        $classesArray = array(); // this array uses to insert unique class

        foreach($enrollments as $enrollment)
        {
            $sub = Subject::find($enrollment->subject_id);

            if(! in_array($sub->class()->get()[0]->id, $classesArray)) // check if the class is already in array or not
            {
                array_push($classesArray, $sub->class()->get()[0]->id);

                $notifications = $sub->class->notifications()->get();

                foreach($notifications as $notfication)
                {
                    $enrolls['data'][$i] = $notfication;
                    $i++;
                }

            }
        }

        // dd(sizeof($enrolls));
        if(sizeof($enrolls) == 0)
            $enrolls["data"] = $enrolls;
        // return json_encode($enrolls);
        return response()->json($enrolls);

    }
}

