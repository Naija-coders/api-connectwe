<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Socialite;

class UserController extends Controller
{
    //
    function index(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'Message' => ['These credential do not match our records']
            ], 404);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            'user' => $user,
            'auth_token' => $token
        ];
        return response($response, 201);
    }
}
