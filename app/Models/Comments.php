<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CommentsController;

class Comments extends Model
{

    protected $dates = ['deleted_at'];
   
    protected $fillable = [
        'user_id',
        'champion_id',
        'parent_id',
        'body'
    ];
   
    
    public function user()
        {
            return $this->belongsTo(User::class);
        }
   
    
    public function replies()
        {
            return $this->hasMany(Comments::class, 'parent_id');
        }

}
