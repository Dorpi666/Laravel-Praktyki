<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
class CharacterController extends Controller
{
    


    public function index()
    {
        $characters = Character::all();
    return view('character.index', [
        'characters' => $characters
    ]);

       // return view('character.index');
    }

    public function show(int $id)
    {
        $character = Character::where('id', $id)->firstOrFail();
        
        return view('character.show', [
            'character' => $character
        ]);
    }
}
