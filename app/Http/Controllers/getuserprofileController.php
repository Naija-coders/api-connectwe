<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class getuserprofileController extends Controller
{
  //
  function getusersprofile(Request $req)
  {

    $user = $req->user();
    if ($user) {
      return response()->json($user, 200);
    } else {
      return response()->json(['message' => "user not found"], 404);
    }
  }
}
