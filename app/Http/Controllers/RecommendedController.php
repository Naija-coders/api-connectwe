<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\recommendedservice;

class RecommendedController extends Controller
{
    //
    function recommended (Request $request){

     
        $categories = $request->categories_id ;
     
        $users = DB::table('Services')
        ->select()
        ->join('categories', 'categories.categories_id', 'Services.categories_id' )->where( 'categories.categories_id', $categories )->get();
        return $users;
    }
}
