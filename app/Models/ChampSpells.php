<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

use Illuminate\Database\Eloquent\Model;

class ChampSpells extends Model
{
    protected $table = 'ChampSpells';

    protected $casts = [
        'SpellName' => AsArrayObject::class,
        'Picture' => AsArrayObject::class,
    ];

    protected $fillable = [
       
        'ChampName',
        'SpellName',
        'Picture',
    ];
    
    protected $attributes = [
        'ChampName' => 'empty',
        'SpellName' => 'empty',
        'Picture' => 'empty',
    ];

}
