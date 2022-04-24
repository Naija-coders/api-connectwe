<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dummyApi extends Controller
{
    //
    function getData(){
        return ["name"=>"mano","email"=>"manoomogha@yahoo.com","phone number"=>"+905488456553"];
    }
}
