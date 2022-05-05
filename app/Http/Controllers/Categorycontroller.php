<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\DB;
class Categorycontroller extends Controller
{
    //
    function getlist(){
        return 
        category::all();
    }
    function list(){
        $users = DB::table('services')
        ->select('users.name', 'users.phone_number', 'users.email', 'services.services_id', 'services.about', 'services.title','services.updated_date' ,'services.image', 'services.categories_id','services.location', 'services.price', 'categories.type', 'categories.job_advertisement')
        ->join('categories', 'services.categories_id', 'categories.categories_id' )->join(
            'users', 'services.id', 'users.id'
        )->orderByDesc('services.updated_date')->get();
        
        return $users;
    }
}
