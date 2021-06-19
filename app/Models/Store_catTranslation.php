<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Store_catTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'feature_title'
    ];
}
