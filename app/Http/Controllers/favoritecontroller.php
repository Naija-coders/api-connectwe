<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Models\favorite;
use Illuminate\Support\Facades\DB;
class favoritecontroller extends Controller
{
    //
    function favorite(Request $request){
         $user_name = $request->user();
      
         $services_id = $request->services_id;
         
         $users = DB::table('Services')
         ->select('services_id')->where('services_id',$services_id)->value('services_id');
        $favorite = new favorite();

       
         $favorite->services_id=$users;
         $favorite->id=$user_name->id;
         
         
 

         
         $result = $favorite->save();
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
