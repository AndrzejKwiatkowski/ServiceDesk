<?php

namespace App\Services;

use App\Comment;
use App\Ticket;

class CommentService implements CommentServiceInterface
{

    public function create(array $data): Comment
    {
             return Comment::create([
            'user_id' => $data['body'],
            'ticket_id' => $data['id'],
            'body' => $data['body']
            ]);
    }

}
