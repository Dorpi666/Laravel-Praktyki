<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterScore extends Model
{

    use HasFactory;

    protected $table = 'characterscore';

    protected $fillable = [
        'Champion_id',
        'User_id',
        'Score',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'UserId');
        
        //return $this->hasOne(User::class);
    }

    public function character()
    {
        return $this->belongsTo('App\Models\Character', 'ChampionId');
        
        //return $this->hasOne(Character::class);
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\CharacterScore');
    }

}
