<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    protected $fillable = [
        'orginal_name',
        'name'
    ];

    public function user(){ // po co ta relacja?
        return $this->belongsTo(User::class);
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
}
