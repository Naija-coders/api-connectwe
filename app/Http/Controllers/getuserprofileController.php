<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class getuserprofileController extends Controller
{
    //
    function getusersprofile(Request $req){
        
       return (
        $user_id = DB::table('auth_token')->where('id', $user_token)->first();
         echo $user_id->id;
       )



    }
}
