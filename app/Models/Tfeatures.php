<?php

namespace App\Models;


use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Tfeatures extends Model
{
    use Translatable;

    public $translatedAttributes = ['name'];

    protected $table = 'transport_features';

    protected $fillable = ['icon'];

    protected $hidden = [];

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    public function getListAll()
    {
        $tfeatures = self::query()
            ->orderBy('created_at', 'desc')
            ->get();

        return $tfeatures;
    }
}
