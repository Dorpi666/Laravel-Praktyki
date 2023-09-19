<?php

namespace App\Http\Controllers;

use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Http\Request;
use App\Models\Comments;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;
use Illuminate\Support\Str;

class CommentsController extends Controller
{
    
    public function store(Request $request)
    {

        
    	$request->validate([
            'body'=>'required',
            
        ]);

        $user = auth()->user()->id;

        if (RateLimiter::tooManyAttempts('send-message:'.$user, $perHour = 120))
            {
                $seconds = RateLimiter::availableIn('send-message:'.$user);
            
                return 'You may try again in '.$seconds.' seconds.';
            }

        elseif (RateLimiter::tooManyAttempts('send-message:'.$user, $perMinute = 5)) 
            {
                $seconds = RateLimiter::availableIn('send-message:'.$user);
            
                return 'You may try again in '.$seconds.' seconds.';
            }
         
        RateLimiter::hit('send-message:'.$user);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $input['body'];
        
        
        if (Str::contains($input['body'], [
            'https://',
            'http://'
        ])) {
            
            return back()->witherrors(['body'=>'nie można zamieszczać tych treści w komentarzach']);
        }
        else {
        Comments::create($input);
        }
        
        // Comments::create($input);
        return back();
    }
}
