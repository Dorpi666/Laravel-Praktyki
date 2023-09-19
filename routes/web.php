<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Character;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\CudController;
use Illuminate\Support\Facades\Gate;
use App\Models\Policies;

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
Route::get('charactersFilter', [CharacterController::class, "filter"])->name('characters.filter');
Route::get('charactersRotation', [CharacterController::class, "rotation"])->name('characters.rotation'); // wyświetlanie championów z rotacji
Route::get('ChampionFromRotation/{string}', [CharacterController::class, "ShowRotationChampion"])->name('rotation.champion'); // wyświetlanie 1 championa z rotacji wraz z informacjami o nim

// route logowania 

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('auth.login');
Route::post('logout', [LoginController::class, 'logout'])->name('auth.logout')->middleware('auth');

Route::get('registration', [RegistrationController::class, "create"])->name('registration.create');
Route::post('register', [RegistrationController::class, "store"])->name('registration.store');


// route komentarzy

Route::post('Comments', [CommentsController::class, "user"])->name('comments.user');
Route::post('Comments', [CommentsController::class, "replies"])->name('comments.replies');
Route::post('Comments', [CommentsController::class, "store"])->name('comments.store')->middleware('auth');


// odnawianie hasła

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


// Opcje użytkownika

Route::get('Options', [OptionsController::class, "index"])->name('options.index');
Route::post('reset-password', [ForgotPasswordController::class, 'LoginsubmitResetPasswordForm'])->name('login.reset.password');
Route::get('characterslist', [CharacterController::class, "CharactersList"])->name('characters.list');
Route::post('Options', [OptionsController::class, "ChangeMain"])->name('user.main');
Route::post('UploadAwatar', [OptionsController::class, "storeAwatar"])->name('store.Awatar');

// Opcje admina

Route::get('CUD', [CharacterController::class, "indexChange"])->name('cud.champions')->can('admin', Character::class);
Route::get('CUD-edit/{id}', [CharacterController::class, "edit"])->name('edit.champions')->can('admin', Character::class);
Route::put('CUD-update/{id}', [CharacterController::class, "update"])->name('update.champions')->can('admin', Character::class);
Route::post('CUD-Add', [CharacterController::class, "add"])->name('add.champions')->can('admin', Character::class);
Route::post('CUD-Delete', [CharacterController::class, "delete"])->name('delete.champions')->can('admin', Character::class);
Route::post('UploadImage/{id}', [CharacterController::class, "storeImage"])->name('store.Image')->can('admin', Character::class);


