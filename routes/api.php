<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dummyApi;
use App\Http\Controllers\manodata;
use App\Http\Controllers\Categorycontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("data",[dummyApi::class, 'getData']);
Route::post("list",[manodata::class, 'list']);
Route::get("Categories",[Categorycontroller::class, 'list']);
Route::post("login", [UserController::class, 'index']);
//for secured routing middleware
Route::group(["middleware"=>'auth:sanctum'],function(){
    
});
Route::post("company/register", [RegistrationController::class, 'registeruser']);