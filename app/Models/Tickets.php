<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    public function attachments()
    {
        return $this->hasMany(Attachments::class);
    }

    public function user_info()
    {
        return $this->belongsTo(User::class,  'user_id', 'id');
    }

    public function status_info()
    {
        return $this->belongsTo(TicketStatus::class,  'status_id', 'id');
    }

    public function category_info()
    {
        return $this->belongsTo(Categories::class,  'category_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class,  'ticket_id', 'id');
    }

    




}
