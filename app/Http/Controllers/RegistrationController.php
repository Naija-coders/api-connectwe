<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\personal_access_token;
use Illuminate\Http\Client\Response;


class RegistrationController extends Controller
{
    //
    function googleLogin(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->photo_url = $request->picture;
        $auth_token = $request->access_token;
        $result = $user->save();
        if (!$result) {
            return response([
                'Message' => ['These credential do not match our records']
            ], 404);
        } else {
            $token = $user->currentAccessToken('auth_token')->plainTextToken;

            $response = [
                'user' => $user,
                'auth_token' => $token
            ];

            return response($response, 201);
        }
    }
    function registeruser(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $result = $user->save();
        $token = new personal_access_token;

        $token->name = "auth_token";
        $token->token = $request->access_token->plainTextToken;

        $token_result = $token->save();

        if (!$result) {

            return response([
                'Message' => ['These credential do not match our records']
            ], 404);
        } else {


            $response = [
                'user' => $user,
                'auth_token' => $token_result
            ];

            return response($response, 201);
        }
    }
}
