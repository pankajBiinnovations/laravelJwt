<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RepoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/






Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
Route::post('logout', [AuthController::class,'logout']);
Route::post('profile', [AuthController::class,'profile']);
Route::get('open', 'DataController@open');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'AuthController@getAuthenticatedUser');
    Route::get('closed', 'DataController@closed');
});


Route::get('userget',[RepoController::class,'userget']);
Route::post('create',[RepoController::class,'create']);
Route::get('delete/{id}',[RepoController::class,'delete']);
Route::post('update/{id}',[RepoController::class,'update']);
