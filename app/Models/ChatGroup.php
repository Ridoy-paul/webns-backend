<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatGroup extends Model
{
    protected $fillable = [
        'ticket_id', 'user_id', 'is_seen'
    ];
}
