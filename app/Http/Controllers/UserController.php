<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function Users()
    { 
        $users = User::all();
        
        return view('Users', [
            'user'=> $users
        ]);
    }

    public function main(int $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $character = $user->character;
        
    }
}
