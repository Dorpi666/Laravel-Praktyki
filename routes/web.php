<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;

use App\Models\Character;



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
Route::get('/', [SiteController::class,"index"])->name('general.home');
Route::get('o-nas', [SiteController::class,"aboutUs"])->name('general.about_us');

Route::get('characters', [CharacterController::class, "index"])->name('characters.index');
Route::get('characters/{id}', [CharacterController::class, "show"])->name('characters.show');