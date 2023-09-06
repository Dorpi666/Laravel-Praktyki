<?php

namespace App\Http\Controllers;

use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Http\Request;
use App\Models\Comments;


class CommentsController extends Controller
{
    public function store(Request $request)
    {
    	$request->validate([
            'body'=>'required',
        ]);
   
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
    
        Comments::create($input);
   
        return back();
    }
}
