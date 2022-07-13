<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function(){
    Route::post("posts", "App\Http\Controllers\PostController@create");
    Route::get("posts/{id}", "App\Http\Controllers\PostController@show");
    Route::put("/posts/{post}", "App\Http\Controllers\PostController@update");
    Route::delete("/posts/{post}", "App\Http\Controllers\PostController@delete");
});


