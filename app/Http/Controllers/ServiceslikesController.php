<?php

namespace App\Http\Controllers;

use App\Models\services_likes;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ServiceslikesController extends Controller
{
    //
    function Likes(Request $request)
    {
        $services_likes = new services_likes();
        $user = Auth::user();
        $userid = $user->id;
        $services_likes->users_id = $userid;
        $services_likes->services_id = $request->services_id;
        $result = $services_likes->save();
        if ($result) {
            $response = [
                'services' => $services_likes
            ];
            return response($response, 201);
        } else {
            return response([
                'Message' => ['failed to like services']
            ], 404);
        }
    }
    function UnLike(Request $request)
    {
        $services_likes = services_likes::where('services_id', $request->services_id)->firstorfail()->delete();
        if ($services_likes) {
            $response = [
                'Message' => ['Record deleted successfully']
            ];
            return response($response, 201);
        } else {
            return response([
                'Message' => ['Failed to delete record']
            ], 404);
        }
    }
}
