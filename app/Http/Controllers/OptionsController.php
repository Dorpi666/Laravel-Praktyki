<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class OptionsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $characters = Character::pluck('name', 'id');
        $selectedID = $user->main_id;
        return view('options', compact('selectedID', 'characters'));
    }

    public function ChangePassword()
    {
	    //
    }

    public function ChangeMain(Request $request)
    {
        
        
        $request->validate([
            'character_id' => 'required',
        ]);


        User::whereId(auth()->user()->id)->update([
            'main_id' => $request->character_id
        ]);

        return back()->with("status", "Main changed successfully!");
	    
    }

    public function storeAwatar(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png|max:2048',
        ]);
        
        $path = storage_path('Awatar');

        if (! is_dir($path)) {
            mkdir($path, 0777, true);
        }

        if ($file = $request->file('image')) {
            $filePath = $file->store(options: 'awatary');
            User::whereId(auth()->user()->id)->update(['userAwatar' => 'storage/Awatar/'.$filePath]);
        }
        

        return redirect()
            ->back()
            ->with('success', 'Image successfully uploaded.');
    }
}
