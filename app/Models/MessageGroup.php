<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageGroup extends Model
{
    protected $guarded = [];

    public function sender_info()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver_info()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function property_info()
    {
        return $this->belongsTo(Properties::class, 'property_code', 'code');
    }

    

    
}
