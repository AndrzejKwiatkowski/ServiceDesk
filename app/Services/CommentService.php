<?php

namespace App\Services;

use App\Comment;

class CommentService implements CommentServiceInterface
{

    public function create(array $data): Comment
    {
             return Comment::create([
                
            'user_id' => $data['user_id'],
            'ticket_id' => $data['ticket_id'],
            'body' => $data['body']
            
            ]);
    }

}
