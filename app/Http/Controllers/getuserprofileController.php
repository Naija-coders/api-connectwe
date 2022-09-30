<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class getuserprofileController extends Controller
{
  //
  function getusersprofile(Request $request)
  {



    $user =  $request->user();
    if ($user) {
      return response()->json($user, 200);
    }
  }
}
