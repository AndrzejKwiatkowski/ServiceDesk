<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = ['solution', 'ticket_id', 'id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function solutionn()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
