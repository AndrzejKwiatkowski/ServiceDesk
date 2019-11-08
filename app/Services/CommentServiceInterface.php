<?php

namespace App\Services;

use App\Comment;

interface CommentServiceInterface
{

    public function create(array $data): Comment;
    

}
