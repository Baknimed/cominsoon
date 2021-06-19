<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TransportTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'menu'];
}
