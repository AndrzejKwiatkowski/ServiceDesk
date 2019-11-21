<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['title', 'body', 'ticket_id'];

     public function comment()
     {
         return $this->belongsTo(Ticket::class, 'ticket_id');
     }
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
