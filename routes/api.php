<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dummyApi;
use App\Http\Controllers\manodata;
use App\Http\Controllers\Categorycontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\getuserprofileController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\favoritecontroller;
use App\Http\Controllers\RecommendedController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GoogleController;
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

Route::get("data", [dummyApi::class, 'getData']);
Route::post("list", [manodata::class, 'list']);
Route::get("Categories", [Categorycontroller::class, 'getlist']);
Route::get("company/categories", [Categorycontroller::class, 'list']);
Route::get("company/allservices", [Categorycontroller::class, 'allservices']);
Route::post("login", [UserController::class, 'index']);
Route::post("googlelogin", [UserController::class, 'googleLogin']);
//for secured routing middleware
Route::group(["middleware" => 'auth:sanctum'], function () {

    Route::post("favorite", [favoritecontroller::class, 'favorite']);
    Route::get("user/favorite", [favoritecontroller::class, 'getFavorite']);
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::post("favorite", [favoritecontroller::class, 'favorite']);
    Route::get("user/favorite", [favoritecontroller::class, 'getFavorite']);
    Route::get("getuserprofile", [getuserprofileController::class, 'getusersprofile']);
});


Route::get("recommended", [RecommendedController::class, 'recommended']);
Route::get("logout", [LogoutController::class, 'performlogout']);
Route::post("company/register", [RegistrationController::class, 'registeruser']);
Route::post("company/googleregister", [RegistrationController::class, 'googleRegister']);
Route::post("business/companyregister", [RegistrationController::class, 'companyRegister']);
Route::post("business/agencyregister", [RegistrationController::class, 'agencyRegistration']);
Route::post("business/contractorregister", [RegistrationController::class, 'contractorRegistration']);
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get("company/services", [ServiceController::class, 'Service']);
