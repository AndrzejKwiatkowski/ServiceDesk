<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;
use App\Solution;

class Ticket extends Model
{
    protected $fillable = ['title', 'body', 'priorytet', 'status', 'user_id', 'solution_id', 'inProgressby']; // priorytet do zmiany na ang, inProgressby to myląca nazwa

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
    public function solutions() // liczba pojedyncza
    {
        return $this->hasOne(Solution::class);
    }
    public function progress() // nazwałbym to inaczej, np ownedBy() albo coś w tym stylu, progress wskazuje na progres, a nie na to kto jest odpowiedzialny za ticket
    {
        return $this->belongsTo(User::class, 'inProgressby', 'id');
    }
}
