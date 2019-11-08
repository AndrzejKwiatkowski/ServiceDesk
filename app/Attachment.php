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
        // To samo co w comment czyli dzieki tej relacji wyciągam kto dodał załącznik. Nie ma jeszcze tego w widoku ale taki jest zamiar.
        return $this->belongsTo(User::class);
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
}
