<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Models\favorite;
use Illuminate\Support\Facades\DB;
class favoritecontroller extends Controller
{
    //
    function getFavorite(Request $request){
        $user_name = $request->user();
        $users = DB::table('favorites')
        ->select('favorites.services_id', 'favorites.id','users.name','services.image','services.price','services.About','services.title','services.location','services.updated_date','services.id')
        ->join('services', 'services.services_id', 'favorites.services_id' )->join(
            'users', 'users.id', 'favorites.id'
        )->where('favorites.id',$user_name->id)->get();
        return $users;
        

    }
    function favorite(Request $request){
         $user_name = $request->user();
      
         $service_id = $request->services_id;
         
         $users = DB::table('Services')
         ->select('services_id')->where('services_id',$service_id)->value('services_id');
        $favorite = new favorite();

       //nothing
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
