<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service;
use Illuminate\Support\Facades\DB;
class ServiceController extends Controller
{
   function Service(Request $request){
    $service = $request->services_id ;
     
    $users = DB::table('Services')
    ->select()->get();
    return $users;

   }
}
