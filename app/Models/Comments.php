<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Str;
use App\Models\User;

class Comments extends Model
{

    protected $dates = ['deleted_at'];
   
    protected $fillable = [
        'user_id',
        'champion_id',
        'parent_id',
        'body'
    ];

    
    public function ApproveComments(): bool
    {
        $user = auth()->user()->id;

        if (Str::contains($this->original_text, [
            'https://', 
            'http://'
        ])) {
            return false;
        }
   
        return $this->getApprovingUsers()->contains($user);
    }
    
    public function user()
        {
            return $this->belongsTo(User::class);
        }
   
    
    public function replies()
        {
            return $this->hasMany(Comments::class, 'parent_id');
        }

}
