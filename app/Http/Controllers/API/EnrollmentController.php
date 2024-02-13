<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index($user_id)
    {
        $user = User::find($user_id);
        $enrollments = $user->enrollments()->get();

        $enrolls = [];
        $i=0;

        foreach($enrollments as $enrollment)
        {
            $sub = $enrollment->subject->get()[0];
            // $enrolls[$i]['enrollment'] = $enrollments;
            $enrolls[$i]['subject'] = $sub;
            $enrolls[$i]['chapters'] = $sub->chapters()->get();
            $i++;
        }
        // $data = [];
        // $data[0]['data'] = $enrolls;
        // return json_encode($enrolls);
        return response()->json([
            "data" => $enrolls
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $enrollment  =  Enrollment::create([
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id
        ]);

        if(! isset($enrollment))
        {
            return response()->json(
                [
                  'message' => 'Fail',
                  'data' => 'something went wrong'
                ],
            );
        }
        

        return response()->json(
            [
              'message' => 'success',
              'data' => $enrollment
            ],
        );
    }
}

