<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CharacterScore extends Model
{

    protected $table = 'characterscore';

    protected $fillable = [
        'Champion_id',
        'User_id',
        'Score',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function character()
    {
        return $this->belongsTo('App\Models\Character');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\CharacterScore');
    }

}
