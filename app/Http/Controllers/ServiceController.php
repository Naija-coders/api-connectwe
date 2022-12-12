<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\Images;
use App\Models\ratings;
use App\Models\service;
use App\Models\Service_prices;
use App\Models\Tags;
use Illuminate\Http\Request;
use App\Models\services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    function PostServices(Request $request)
    {
        $categories = categories::where('type', $request->type)->first();
        if ($categories) {
            $user = Auth::user();
            $userid = $user->id;
            $services = new services();
            $tags = new Tags;
            $services->overview = $request->overview;
            $services->delivery_time = $request->delivery_time;
            $services->categories_id = $categories->id;
            $services->privacy = "private";
            $services->pitch = $request->pitch;
            $services->users_id = $userid;
            $services->location = $request->location;
            $services->location_type = $request->location_type;
            $tags->tag_name = $request->tag_name;
            $tags->categories_id = $categories->id;
            $prices = new Service_prices();
            $prices->currency = $request->currency;
            $prices->price = $request->price;
            $prices->user_id = $userid;
            $images = new Images();




            $prices->save();

            $tags->save();
            $tagstype = Tags::where('tag_name', $request->tag_name)->first();
            if ($tagstype) {
                $services->tags_id = $tagstype->id;
                if ($prices) {
                    $services->price_id = $prices->id;
                    $images->image_url = $request->image_url;
                    $images->save();
                    $imagestring = Images::where("image_url", $request->image_url)->first();
                    if ($imagestring) {
                        $services->images_id = $imagestring->id;
                        $result =   $services->save();
                        if (!$result) {

                            return response([
                                'Message' => ['These credential do not match our records']
                            ], 404);
                        } else {
                            $response = [
                                'services' => $services
                            ];
                            return response($response, 201);
                        }
                    } else {
                        return response([
                            'Message' => ['Please enter tags']
                        ], 404);
                    }
                }
            } else {
                return response([
                    'Message' => ['Please enter tags']
                ], 404);
            }
        } else {
            return response([
                'Message' => ['These categories does not exist']
            ], 404);
        }
    }
    function ExplorePaginated(Request $request)
    {
        $service = DB::table('services')->select('services.*', 'images.image_url', 'users.name', 'users.profile_photo_path', 'tags.tag_name', 'categories.type', 'service_prices.currency', 'service_prices.price')->join('categories', 'categories.id', 'services.categories_id')->join('images', 'images.id', 'services.images_id')->join('users', 'users.id', 'services.users_id')->join('tags', 'tags.id', 'services.tags_id')->join('service_prices', 'service_prices.id', 'services.price_id')->paginate(12);
        return $service;
    }
    function ExplorePaginatedSubcategory(Request $request)
    {
        $service = DB::table('services')->select('services.*', 'images.image_url', 'users.name', 'users.profile_photo_path', 'tags.tag_name', 'categories.type', 'service_prices.currency', 'service_prices.price')->join('categories', 'categories.id', 'services.categories_id')->join('images', 'images.id', 'services.images_id')->join('users', 'users.id', 'services.users_id')->join('tags', 'tags.id', 'services.tags_id')->join('service_prices', 'service_prices.id', 'services.price_id')->where('tags.tag_name', $request->tags)->paginate(12);
        return $service;
    }
    function Service(Request $request)
    {
        /*     $user_name = $request->user();
      $users = DB::table('favorites')
      ->select('favorites.services_id', 'favorites.id','users.name','services.image','services.price','services.About','services.title','services.location','services.updated_date','services.id')
      ->join('services', 'services.services_id', 'favorites.services_id' )->join(
          'users', 'users.id', 'favorites.id'
      )->where('favorites.id',$user_name->id)->get();
      return $users;
      
    $service = $request->services_id ; */
        //please revise this once everythign is fixed
        $service = DB::table('services')->select('services.*', 'images.image_url', 'users.name', 'users.profile_photo_path', 'tags.tag_name', 'categories.type', 'service_prices.currency', 'service_prices.price')->join('categories', 'categories.id', 'services.categories_id')->join('images', 'images.id', 'services.images_id')->join('users', 'users.id', 'services.users_id')->join('tags', 'tags.id', 'services.tags_id')->join('service_prices', 'service_prices.id', 'services.price_id')->get();
        $records = collect($service)->slice(0, 4)->all();
        return $records;
        /*    $users = DB::table('Services')->select('Services.services_id', 'Services.categories_id', 'Services.image', 'Services.location', 'Services.price', 'Services.About', 'Services.title', 'Services.updated_date', 'categories.type', 'users.name', 'users.email')->join('categories', 'categories.categories_id', 'Services.categories_id')->join('users', 'users.id', 'Services.id')->get();

        return $users;
 */
    }
}
