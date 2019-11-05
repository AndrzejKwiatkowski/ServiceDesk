<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = ['solution', 'ticket_id', 'id'];


    public function user() // nie potrzebujesz tej relacji, jaki jest jej sens? ticket ma relacje do gościa który jest odpowiedzialny za ticket
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
