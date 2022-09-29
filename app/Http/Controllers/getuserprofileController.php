<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class getuserprofileController extends Controller
{
    //
    function getusersprofile(Request $req){
      $user_id = DB::table('auth_token')->where('id', $user_token)->first()
if($user_id){
  $user = Auth::user();
  return response()->json($user,200)
}
else{
  return response()->json(["message"=>"not authenticated"],404)
}
       return (
        $user_id = DB::table('auth_token')->where('id', $user_token)->first()
        
       );



    }
}
