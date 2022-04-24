<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class RegistrationController extends Controller
{
    //
    function registeruser( Request $request){
        $user = new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password= Hash::make($request->password);
        $result = $user->save();
        if(!$result){
            return response([
                'Message'=>['These credential do not match our records']
            ], 404);
        }


        
        else{
            $response = "successfully registered";
               
           
            return response($response, 201);
        }
       
    }
}
