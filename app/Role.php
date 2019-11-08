<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
