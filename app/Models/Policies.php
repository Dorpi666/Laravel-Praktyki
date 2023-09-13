<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Character;


class Policies extends Model
{

    public function Character(User $user): bool
    {
        return $user->role === 'admin';
    }
    
}
