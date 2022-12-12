<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GoogleController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/', function () {
    return view('welcome');
});

if(\Illuminate\Support\Facades\App::environment('local')){
    Route::get('/playground', function (){
        $user = App\Models\User::factory()->make();
        \Illuminate\Support\Facades\Mail::to($user)
        ->send(new \App\Mail\welcomeEmail($user));
        return null;

    });
}

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('https://business.elverr.com/');
    })->name('dashboard');

});
