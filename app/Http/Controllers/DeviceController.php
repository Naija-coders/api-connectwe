<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\godchild;

class DeviceController extends Controller
{
    //
    function list(){
        return godchild::all();

    }
}
