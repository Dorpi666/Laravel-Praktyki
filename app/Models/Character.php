<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\CharacterController;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Character extends Model
{
    protected $table = 'LeagueCharacters';
    
    public function Users()
    {
        return $this->hasMany(User::class, 'main_id');
        
    }

    public function CharacterScore()
    {

        
        return $this->hasMany(CharacterScore::class, 'CharacterScoreId');
        
    }

    protected $fillable = [
        'id',
        'name',
        'role',
        'lane',
        'shop-cost',
        'difficulty',
        'ChampPicture'
    ];
    
    protected $attributes = [
        'ChampPicture' => 'unknown.png',
        'role' => 'empty',
        'lane' => 'empty',
        'shop-cost' => 0,
        'difficulty' => 1,
    ];

    public function imageUrlAwatar(): Attribute{
    
        return Attribute::make(
            get: fn ($value) => "http://ddragon.leagueoflegends.com/cdn/13.18.1/img/champion/".$this->ChampPicture
        );

    }

    public function imageUrlBanner(): Attribute{
    
        return Attribute::make(
            get: fn ($value) => "http://ddragon.leagueoflegends.com/cdn/img/champion/loading/".$this->name."_0.jpg"
        );

    }

    
    public function comments()
    {
        return $this->hasMany(Comments::class, 'champion_id')->whereNull('parent_id');
    }

    
}
