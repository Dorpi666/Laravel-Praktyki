<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Image;
use App\Helper\ImageManager;
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{
    use ImageManager;


    public function index()
    {
        $characters = Character::all();
        return view('character.index', [
        'characters' => $characters
    ]);

       // return view('character.index');
    }
    
    public function indexChange()
    {
        $characters = Character::all();
        return view('character.CUD-Champions', [
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

    public function add(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'lane' => 'required',
            'shop-cost' => 'required|numeric',
            'difficulty' => 'required',
            
        ]);
        
        Character::create($request->all());
        
        return back()->with("status", "Pomyślnie dodano championa!");
    }

    public function delete(Request $request)
    {

        $request->validate([
            'champion_id' => 'required',
        ]);
        
        $character = Character::where('id', $request->input('champion_id'))->firstOrFail();
        $character->delete();

        return back()->with("status", "Champion deleted successfully!");
	    
    }
    
    public function edit($id)
    {
        $character = Character::find($id);
        $characters = Character::pluck('name','id');
        return view('character.CUD-Champions', compact('character', 'characters'));
    }

    public function update(Request $request, $id)
    {
        
        $character = Character::find($id);
        $character->fill($request->all());
        /*$character->name = $request->input('name');
        $character->role = $request->input('role');
        $character->lane = $request->input('lane');
        $character->setAttribute('shop-cost', $request->input('shop-cost'));
        $character->difficulty = $request->input('difficulty');
        */
        $character->save();
        return redirect()->back()->with('status','Champion Updated Successfully');
	    
    }

    public function storeImage(Request $request, $id)
{
    $request->validate([
        'image' => 'required|image|mimes:png|max:2048',
    ]);
    
    $path = storage_path('Grafika');

    if (! is_dir($path)) {
        mkdir($path, 0777, true);
    }

    if ($file = $request->file('image')) {
        $filePath = $file->store(options: 'grafiki');
        Character::where('id', $id)->update(['ChampPicture' => 'storage/Grafika/'.$filePath]);
    }
    

    return redirect()
        ->back()
        ->with('success', 'Image successfully uploaded.');
}

    
}
