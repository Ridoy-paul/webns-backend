<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function user_info()
    {
        return $this->belongsTo(User::class,  'user_id', 'id');
    }
}
