<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Store_cat extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'feature_title'];

    protected $table = 'store_cat';

    protected $fillable = [
        'slug', 'priority', 'is_feature', 'feature_title', 'icon_map_marker', 'color_code', 'status', 'seo_title', 'seo_description'
    ];

    protected $hidden = [];

    protected $casts = [
        'priority' => 'integer',
        'is_feature' => 'integer',
        'status' => 'integer'
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    const IS_FEATURE = 1;

    const TYPE_PLACE = "place";
    const TYPE_POST = "post";
    const TYPE_TRANSPORT = "transport";



    public function getListAll()
    {
        $categories = self::query()
            ->orderBy('priority', 'asc')
            ->get();

        return $categories;
    }

    public function getById($id)
    {
    }

    public function getBySlug($slug)
    {
    }
}
