<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlists';

    protected $fillable = [
        'user_id', 'item_id', 'item_type'
    ];

    protected $hidden = [];

    protected $casts = [
        'user_id' => 'integer',
        'item_id' => 'integer',
        'item_place' => 'json'
    ];
}
