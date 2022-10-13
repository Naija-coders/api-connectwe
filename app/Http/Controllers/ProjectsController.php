<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Projects;
use App\Models\Tags;
use App\Models\categories;
use App\Models\Prices;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectsController extends Controller
{
    function myprojects(Request $request)
    {

        $categories = categories::where('type', $request->type)->first();
        if ($categories) {
            $user = Auth::user();
            $userid = $user->id;
            $project = new Projects;
            $tags = new Tags;


            $project->title = $request->title;
            $project->overview = $request->overview;
            $project->location = $request->location;
            $project->location_type = $request->location_type;
            $project->categories_id = $categories->id;
            $project->user_id = $userid;
            $project->privacy = "private";
            $tags->tag_name = $request->tag_name;
            $tags->categories_id = $categories->id;
            $prices = new Prices;
            $prices->currency = $request->currency;
            $prices->price = $request->price;
            $prices->user_id = $userid;
            $prices->save();

            $tags->save();
            $tagstype = Tags::where('tag_name', $request->tag_name)->first();
            if ($tagstype) {
                $project->tags_id = $tagstype->id;
                if ($prices) {
                    $project->price_id = $prices->id;
                    $result =   $project->save();
                    if (!$result) {

                        return response([
                            'Message' => ['These credential do not match our records']
                        ], 404);
                    } else {
                        $response = [
                            'projects' => $project
                        ];
                        return response($response, 201);
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
}
