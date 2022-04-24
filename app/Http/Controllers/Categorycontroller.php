<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
class Categorycontroller extends Controller
{
    //
    function list(){
        return category::all();
    }
}
