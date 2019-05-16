<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;

class Ticket extends Model
{
    protected $fillable = ['title', 'body', 'priorytet', 'status','user_id'];

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

}
