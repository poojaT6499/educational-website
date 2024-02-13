<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChaptersResource;
use App\Http\Resources\SubjectsResource;
use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubjectsResource::collection(Subject::all());
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
        return new SubjectsResource(Subject::findOrFail($id));
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
    public function classSubjects($id)
    {
        return SubjectsResource::collection(Subject::where('class_id', '=', $id)->get());
    }

    public function mediaCount($id)
    {
        return Subject::findOrFail($id)->medias()->count();
    }

    public function SubjectChaptersCount($id)
    {
        return Subject::findOrFail($id)->chapters()->count();
    }

    public function searchBySubjName($name)
    {
        $subject = array();
        $name = trim($name);
        $subject['data'] = Subject::where('name', $name)
                    ->orWhere('name', strtolower($name))
                    ->orWhere('name', strtoupper($name))
                    ->orWhere('name', ucfirst($name))
                    ->get();

        // dd(sizeof($subject));

        return $subject;
    }
}
