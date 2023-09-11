<?php

namespace App\Policies;

use App\Models\Character;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function admin(User $user): bool
    {
        return $user->role === 'admin';
    }
}
