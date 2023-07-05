<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepoController;
use App\Http\Controllers\DataController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::any('get-session',[HomeController::class,'get']);
Route::any('set-session',[HomeController::class,'set']);
Route::any('forget',[HomeController::class,'forget']);

Route::get('userget',[RepoController::class,'userget']);
Route::get('delete/{id}',[RepoController::class,'delete']);
Route::get('update/{id}',[RepoController::class,'update']);


Route::view('/insert-data', 'insert-data');
Route::post('/insert-data', [DataController::class,'insertData'])->name('insert.data');


require __DIR__.'/auth.php';
