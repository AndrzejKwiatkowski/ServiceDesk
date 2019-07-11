<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = ['description', 'ticket_id'];

     public function solution()
     {
         return $this->belongsTo(Solution::class, 'ticket_id');
     }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
