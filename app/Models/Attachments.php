<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    protected $fillable = [
        'tickets_id',
        'file_path',
        'file_name'
    ];
}
