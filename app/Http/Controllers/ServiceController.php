<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service;
use Illuminate\Support\Facades\DB;
class ServiceController extends Controller
{
   function Service(Request $request){
  /*     $user_name = $request->user();
      $users = DB::table('favorites')
      ->select('favorites.services_id', 'favorites.id','users.name','services.image','services.price','services.About','services.title','services.location','services.updated_date','services.id')
      ->join('services', 'services.services_id', 'favorites.services_id' )->join(
          'users', 'users.id', 'favorites.id'
      )->where('favorites.id',$user_name->id)->get();
      return $users;
      
    $service = $request->services_id ; */
     //please revise this once everythign is fixed
    $users = DB::table('Services') ->select('Services.services_id, Services.image, Services.location,Services.price,Services.About,Services.title, Services.updated_date, categories.type', 'users.name', 'users.email', 'users.id')->join('categories', 'categories.categories_id', 'Services.categories_id')->join('users', 'users.id', 'Services.id')->get();
    
    return $users;

   }
}
