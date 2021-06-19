<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Saves extends Model
{
    protected $table = 'saves';

    protected $fillable = [
        'user_id', 'event'
    ];

    protected $hidden = [];

    protected $casts = [
        'user_id' => 'integer',
        'event_id' => 'integer'
    ];
}
