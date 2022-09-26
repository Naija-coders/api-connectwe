<?php

namespace App\Http\Controllers;

use App\Models\agencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\businesses;
use App\Models\contractors;

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
    function companyRegister(Request $request)
    {
        $user = new User;
        $user->name = $request->company_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $result = $user->save();
        if (!$result) {

            return response([
                'Message' => ['These credential do not match our records']
            ], 404);
        } else {
            $token = $user->createToken('auth_token')->plainTextToken;

            $business = new businesses;

            $business->id = $user->id;
            $business->company_name = $user->name;
            $business->company_size = $request->company_size;
            $business->is_business = 1;
            $business->location = $request->location;
            $business->save();
            $response = [
                'user' => $user,
                'auth_token' => $token,
                'businesses' => $business,
            ];
            return response($response, 201);
        }
    }
    function agencyRegistration(Request $request)
    {
        $user = new User();
        $user->name = $request->company_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $result = $user->save();
        if (!$result) {

            return response([
                'Message' => ['These credential do not match our records']
            ], 404);
        } else {
            $token = $user->createToken('auth_token')->plainTextToken;

            $business = new agencies();

            $business->id = $user->id;
            $business->agency_name = $user->name;
            $business->agency_size = $request->agency_size;

            $business->location = $request->location;
            $business->save();
            $response = [
                'user' => $user,
                'auth_token' => $token,
                'businesses' => $business,
            ];
            return response($response, 201);
        }
    }
    function contractorRegistration(Request $request)
    {
        $user = new User();
        $user->name = $request->company_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $result = $user->save();
        if (!$result) {

            return response([
                'Message' => ['These credential do not match our records']
            ], 404);
        } else {
            $token = $user->createToken('auth_token')->plainTextToken;

            $business = new contractors();

            $business->id = $user->id;
            $business->company_name = $user->name;
            $business->company_size = $request->company_size;
            $business->is_business = 1;
            $business->location = $request->location;
            $business->save();
            $response = [
                'user' => $user,
                'auth_token' => $token,
                'businesses' => $business,
            ];
            return response($response, 201);
        }
    }
}
