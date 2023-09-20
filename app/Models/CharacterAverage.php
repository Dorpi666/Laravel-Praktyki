<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CharacterAverage extends Model
{
    protected $table = 'characteraverage';

    protected $fillable = [
        'Champion_id',
        'Whole_Score',
        'How_Much_Reviews',
    ];

    public function character()
    {
        return $this->belongsTo('App\Models\Character');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\CharacterScore');
    }

}
