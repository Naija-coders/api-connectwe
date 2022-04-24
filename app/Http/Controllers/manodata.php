<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\manodb;
class manodata extends Controller
{
    //
    function list(Request $req){
        $Manodb = new manodb;
        $Manodb->itwillwork = $req->itwillwork;
        $Manodb->email=$req->email;
        $Manodb->save();
        return ["Result"=>"data h as been saved"];
    }
}
