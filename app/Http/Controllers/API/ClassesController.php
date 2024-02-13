<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassesResource;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClassesResource::collection(Classes::all());
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
        // dd($request);
        $payload = json_decode($request->getContent(), true);
        // dd($payload);
        $query = Classes::create([
            'name' => $payload['name'],
            'status' => $payload['status'],
            'deleted_at' => $payload['deleted_at'],
            'created_at' => $payload['created_at'],
            'updated_at' => $payload['updated_at'],
        ]);

        return response()->json(
            [
              'message' => 'success',
              'data' => $query
            ],
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ClassesResource(Classes::findOrFail($id));
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
        $payload = json_decode($request->getContent(), true);

        $classes = Classes::find($id);
        $classes->name = $payload['name'];
        $classes->status = $payload['status'];
        $classes->deleted_at = $payload['deleted_at'];
        $classes->created_at = $payload['created_at'];
        $classes->updated_at = $payload['updated_at'];

        // $classes->update([
        //     'name' => $payload['name'],
        //     'status' => $payload['status'],
        //     'deleted_at' => $payload['deleted_at'],
        //     'created_at' => $payload['created_at'],
        //     'updated_at' => $payload['updated_at'],
        // ]);

        $classes->save();

        return response()->json(
            [
              'message' => 'success',
              'data' => $classes
            ],
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classes = Classes::find($id);
        $flag = false;

        if($classes) {
            $no = $classes->delete();
            if($no == 1) {
                $flag = true;
            }
            return response()->json(
                [
                  'message' => 'successful',
                  'status' => $flag
                ],
            );
        }

        return response()->json(
            [
              'message' => 'unsuccessful',
              'status' => $flag
            ],
        );

    }
}
