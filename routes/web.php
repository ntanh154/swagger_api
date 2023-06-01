<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::group(["prefix"=>"api/v1/post"],function(){
    Route::get("/get/{id}",[PostController::class,"get"]);
    Route::get("/gets",[PostController::class,"gets"]);
    Route::post("/store",[PostController::class,"store"]);
    Route::put("/update/{id}",[PostController::class,"update"]);
    Route::delete("/delete/{id}",[PostController::class,"delete"]);
});