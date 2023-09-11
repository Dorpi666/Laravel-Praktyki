<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class CudController extends Controller
{
    public function index()
    {
        $character = Character::all();
	    return view('CUD-Champions', compact('character'));
    }

    public function add()
    {
        $this->validate(request(), [
            'name' => 'required',
            'role' => 'required',
            'lane' => 'required',
            'shop-cost' => 'required',
            'difficulty' => 'required',
            'ChampPicture' => 'required' // Zmienić ChampPicture pod ("storage/Grafika"$name) czy coś takiego
        ]);
        
        $character = Character::create(request(['name', 'role', 'lane', 'shop-cost', 'difficulty', 'ChampPicture']));
        
        return back()->with("status", "Pomyślnie dodano championa!");
    }

    public function delete(Request $request, int $id)
    {
        
        
        $request->validate([
            'champion_id' => 'required',
        ]);


        $character = Character::where('id', $id)->firstOrFail();
        $character->delete();

        return back()->with("status", "Champion deleted successfully!");
	    
    }

    public function update(Request $request, $name)
    {
        
        $character = Character::find($name);
        $character->name = $request->input('name');
        $character->role = $request->input('role');
        $character->lane = $request->input('lane');
        $character->shopcost = $request->input('shop-cost');
        $character->difficulty = $request->input('difficulty');
        $character->update();
        return redirect()->back()->with('status','Champion Updated Successfully');
	    
    }

}
