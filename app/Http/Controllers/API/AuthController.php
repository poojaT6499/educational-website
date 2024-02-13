<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'unique:users|required|min:10|max:10',
            'email'    => 'unique:users|required|string|email|max:255',
            'password' => 'required|string|min:8',
        ];

        $input = $request->only('name','phone','email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json([
                'code' => 500,
                'success' => false,
                'error' => $validator->messages()
            ]);
        }
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json([
            'code' => 200,
            'success' => true,
            'user' => $user
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected function login(Request $request)
    {
        $user = User::where('email', $request->email)->where('role',2)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)) {
                if ($user->isStudent()) {
                    return response()->json([
                        'code' => 200,
                        'success' => true,
                        'user' => $user
                    ]);
                }
                return response()->json([
                    'code' => 401,
                    'success' => false,
                    'message' => "Unauthorized"
                ]);
            }
        }
        return response()->json([
            'code' => 401,
            'success' => false,
            'message' => "Forbidden: Wrong username or password"
        ]);
    }

    public function forgotPassword(Request $request) {
        
        $user = User::where('phone', $request->phone)->first();
        if($user === null)
        {
            return response()->json([
                'code' => 200,
                'success' => false,
                'user' => $user
            ]);
        }
            
        $user->password = Hash::make($request->password);
        $user->update();

        return response()->json([
            'code' => 200,
            'success' => true,
            'user' => $user
        ]);
    }
}
