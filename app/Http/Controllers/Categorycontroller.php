<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\DB;
class Categorycontroller extends Controller
{
    //
    function list(){
        $users = DB::table('Services')
        ->select('users.name', 'users.phone_number', 'users.email', 'Services.services_id', 'Services.image', 'Services.categories_id','Services.location', 'Services.price', 'categories.type', 'categories.job_advertisement')
        ->join('categories', 'Services.categories_id', 'categories.categories_id' )->join(
            'users', 'Services.id', 'users.id'
        )->get();
        
        return $users;
    }
}
