<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    const ADMIN_ROLE_ID = 1;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
