<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\CharacterController;

class Character extends Model
{
    protected $table = 'LeagueCharacters';
    
    public function Users()
    {
        return $this->hasMany(User::class, 'main_id');
        
    }

    protected $fillable = [
        'name',
        'role',
        'lane',
        'shop-cost',
        'difficulty',
        'ChampPicture'
    ];
    
    protected $attributes = [
        'ChampPicture' => 'unknown.png'
    ];
    
    public function comments()
    {
        return $this->hasMany(Comments::class, 'champion_id')->whereNull('parent_id');
    }

    
}
