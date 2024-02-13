<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        //return ClassesResource::collection(Classes::all());
    }



    public function store(Request $request)
    {

    }


    public function show($id)
    {
        $user = User::where('id',$id)->where('role',2)->get();
        return response()->json([
            "data" => $user
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        // dd($request);
        $user = User::find($request->user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->save();

        return response()->json(
            [
              'message' => 'success',
              'data' => $user
            ],
        );
    }

    public function passwordUpdate(Request $request)
    {
        $user = User::find($request->user_id);
        $pass = Hash::make($request->password);
        $user->update([
            'password' => $pass
        ]);

        $user->save();

        return response()->json(
            [
              'message' => 'success',
              'data' => $user
            ],
        );
    }
}
