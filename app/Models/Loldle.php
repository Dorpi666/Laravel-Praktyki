<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;


class Loldle extends Model
{
    protected $table = 'LoldleChamp';

    protected $casts = [
        'tags' => AsArrayObject::class,
    ];

    protected $fillable = [
        'id',
        'name',
        'partype',
        'stats',
        'difficulty',
        'tags',
    ];
    
    protected $attributes = [
        'name' => 'empty',
        'partype' => 'empty',
        'stats' => 'empty',
        'tags' => 'empty',
        'difficulty' => 1,
    ];

}
