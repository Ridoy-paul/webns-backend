<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    protected $fillable = [
        'chat_group_id', 'ticket_id', 'user_id', 'message'
    ];
}
