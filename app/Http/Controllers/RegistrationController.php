<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;




class RegistrationController extends Controller
{
    //
    function googleRegister(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $user = new User;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->photo_url = $request->picture;




            $result = $user->save();

            if (!$result) {
                return response([
                    'Message' => ['These credential do not match our records']
                ], 404);
            } else {
                $token = $user->createToken('auth_token')->plainTextToken;

                $response = [
                    'user' => $user,
                    'auth_token' => $token
                ];

                return response($response, 201);
            }
        } else {
            return response([
                'Message' => ['User already exist']
            ], 404);
        }
    }
    function registeruser(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $result = $user->save();
        if (!$result) {

            return response([
                'Message' => ['These credential do not match our records']
            ], 404);
        } else {
            $token = $user->createToken('auth_token')->plainTextToken;

            $response = [
                'user' => $user,
                'auth_token' => $token
            ];

            return response($response, 201);
        }
    }
}
