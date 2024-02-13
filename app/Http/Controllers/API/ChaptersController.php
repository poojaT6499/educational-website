<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChaptersResource;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class ChaptersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // send notes_url in notes obj
        // return $chapter = new ChaptersResource(Chapter::findOrFail($id));
        $chapter = Chapter::findOrFail($id);
        $subject = $chapter->subject()->get();
        $media = $chapter->media()->get();
        $notes = $chapter->notes()->get();

        $notesUpdated = [];
        $i=0;
        foreach($notes as $note)
        {
            $temp = json_decode($note);
            $temp->note_url = $note->file;
            $notesUpdated[$i] = $temp;
            $i++;
        }

        $data["data"] = $chapter;
        $data["data"]["subject"] = $subject;
        $data["data"]["media"] = $media;
        $data["data"]["notes"] = $notesUpdated;
        // dd(json_encode($data));
        // $json = (
        //     'data' => $data,
        // );
        // return json_encode($data);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getUserEnrollmentStatus($subj_id, $user_id)
    {
        $user = User::find($user_id);
        $enrollments = $user->enrollments()->get();

        foreach($enrollments as $enrollment)
        {
            if($enrollment->subject_id == $subj_id)
            {
                return true;
            }
        }
        return false;
    }

    public function SubjectChapters($id, $user_id)
    {
        // $data["is_enroll"] = true;
        $data = ChaptersResource::collection(Chapter::where('subject_id', '=', $id)->with('subject', 'media', 'notes')->get());
        // $data[sizeof($data)-1]["is_enroll"] = "true";
        // return $data;
        $is_enroll = $this->getUserEnrollmentStatus($id, $user_id);

        foreach($data as $d)
        {
            $d["is_enroll"] = $is_enroll;
        }
        return $data;
    }

    public function getPopularTopics()
    {
        $chapters = Chapter::all();
        $data = array();
        $i=0;
        if(! isset($chapters))
        {
            return response()->json([
                'message' => 'Fail',
                'data' => 'something went wrong'
            ]);
        }
        foreach($chapters as $chapter)
        {
            $data = $chapter->with('subject')->get();
            $i++;
        }
        return response()->json([
            "data" => $data
        ]);

    }
}
