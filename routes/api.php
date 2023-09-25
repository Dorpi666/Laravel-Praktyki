<?php

use App\Http\Resources\ChampionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Character;
use App\Models\CharacterScore;
use App\Http\Resources\ChampionScoreResource;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Models\Comments;
use App\Http\Resources\CommentsResource;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('champions', function () {
    return ChampionResource::collection(Character::All());
});

Route::get('champions/{id}', function (string $id) {

    
    $comment = Character::findOrFail($id);
    return new ChampionResource($comment->load('comments'));
    
    //return new ChampionResource(Character::findOrFail($id));
});


Route::get('users', function () {
    return UserResource::collection(User::All());
});


Route::get('users/{id}', function (string $id) {
    return new UserResource(User::findOrFail($id));
});


Route::get('CharacterScore', function () {
    return ChampionScoreResource::collection(CharacterScore::with('character', 'user')->get());
});


Route::get('CharacterScore/{id}', function (string $id) {
    $score = CharacterScore::findOrFail($id);
    return new ChampionScoreResource($score->load('character', 'user'));
});

/*
Route::get('Comments', function () {
    return CommentsResource::collection(Comments::with('comments')->get());
});
*/