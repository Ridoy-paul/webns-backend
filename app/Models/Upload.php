<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'file_original_name', 'file_name', 'usersuper_id', 'extension', 'type', 'file_size',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
