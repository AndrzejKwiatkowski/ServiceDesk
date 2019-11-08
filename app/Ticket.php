<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;
use App\Solution;

class Ticket extends Model
{
    protected $fillable = ['title', 'body', 'priorytet', 'status', 'user_id', 'inProgressby']; // priorytet do zmiany na ang, inProgressby to myląca nazwa

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
    public function solution()
    {
        return $this->hasOne(Solution::class);
    }
    public function ownedBy()
    {
        return $this->belongsTo(User::class, 'inProgressby', 'id');
    }
}
