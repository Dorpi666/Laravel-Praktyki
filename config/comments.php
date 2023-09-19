<?php
use App\Models\User;
use App\Models\Comments;

/*
return [
    // ...
    
    /*
     * Comments need to be approved before they are shown. You can opt
     * to have all comments to be approved automatically.
     
    'automatically_approve_all_comments' => false,

    PendingCommentNotification::sendTo(function(Comment $comment) {
        return User::where('is_admin', true)->get(); // select some users
    })

];
*/