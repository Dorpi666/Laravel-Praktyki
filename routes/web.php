<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Character;
use App\Http\Controllers\LoginController;




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
// route championów
Route::get('/', [SiteController::class,"index"])->name('general.home');
Route::get('Users', [UserController::class,"Users"])->name('Show.Users')->middleware('auth');
Route::get('characters', [CharacterController::class, "index"])->name('characters.index');
Route::get('characters/{id}', [CharacterController::class, "show"])->name('characters.show');


// route logowania 
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('auth.login');
Route::post('logout', [LoginController::class, 'logout'])->name('auth.logout')->middleware('auth');

// route komentarzy
Route::get('Comments', [CommentsController::class, "user"])->name('comments.user');
Route::get('Comments', [CommentsController::class, "replies"])->name('comments.replies');
Route::get('Comments', [CommentsController::class, "replies"])->name('comments.store');
