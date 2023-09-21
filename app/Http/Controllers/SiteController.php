<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\CharacterScore;
use Illuminate\Database\Eloquent\Collection;

class SiteController extends Controller
{
    public function index()
    {
        $average = CharacterScore::all()->groupBy('ChampionId');
        $average = $average->mapWithKeys(function ($champion, $id) {
            return [$id => [
                'id' => $id,
                'avg' => $champion->avg('Score')
            ]];
        });
        //dd($average);
        $averageReview = $average->sortByDesc('avg')->first();
        //dd($averageReview);
        $ReviewChampName = Character::where('id', $averageReview['id'])->pluck('name')->first();
        //$ReviewChampName = collect($ReviewChampName)->implode(' ');
        
       // dd($ReviewChampName);
       $character = Character::where('id', $averageReview['id'])->firstOrFail();
       $imageUrlBanner = $character->image_url_banner;

        return view('home', ['averageReview' => $averageReview['avg'], 'ReviewChampName' => $ReviewChampName, 'imageUrlBanner' => $imageUrlBanner,]);
    }
    
}
