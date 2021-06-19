<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model  implements TranslatableContract
{
    use Translatable, HasJsonRelationships {
        Translatable::getAttribute insteadof HasJsonRelationships;
    }

    public $translatedAttributes = ['name', 'description'];

    protected $casts = [

        'name' => 'json',
        'description' => 'json',
        'gallery' => 'json',
        'user_id' => 'integer',
        'place_id' => 'integer',
        'city_id' => 'integer',
        'price' => 'integer',
        'quantity' => 'integer',
        'status' => 'integer'
    ];

    protected $table = 'products';

    protected $fillable = [
        'user_id', 'country_id', 'city_id', 'category', 'name', 'slug', 'price_range', 'quantity',
        'amenities', 'address', 'lat', 'lng', 'email', 'phone_number', 'website', 'social', 'opening_hour',
        'thumb', 'gallery', 'video', 'booking_type', 'link_bookingcom', 'status', 'seo_title', 'seo_description', 'menu', 'faq'
    ];

    protected $hidden = [];

    const STATUS_DEACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_PENDING = 2;
    const STATUS_DELETE = 4;

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'store_id');
    }

    public function categories()
    {
        return $this->belongsToJson(Store_cat::class, 'category');
    }

    public function list_amenities()
    {
        return $this->belongsToJson(Amenities::class, 'amenities');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'place_id', 'id');
    }

    public function avgReview()
    {
        return $this->reviews()
            ->selectRaw('avg(score) as aggregate, place_id')
            ->groupBy('place_id');
    }

    public function getAvgReviewAttribute()
    {
        if (!array_key_exists('avgReview', $this->relations)) {
            $this->load('avgReview');
        }
        $relation = $this->getRelation('avgReview')->first();
        return ($relation) ? $relation->aggregate : null;
    }

    public function wishList()
    {
        return $this->hasMany(Wishlist::class, 'place_id', 'id')->where('user_id', Auth::id());
    }

    public function getAll()
    {
        return self::query()
            ->with('place')
            ->get();
    }

    public function listByFilter($country_id, $store_id, $cat_id)
    {
        $stores = self::query()
            ->with('products')
            ->with('categories')
            ->orderBy('id', 'desc');

        if ($country_id)
            $stores->where('country_id', $country_id);

        if ($store_id)
            $stores->where('store_id', $store_id);

        if ($cat_id)
            $stores->where('category', 'like', '%' . $cat_id . '%');

        $places = $stores->get();

        return $places;
    }

    public function getBySlug($slug)
    {
        $place = self::query()
            ->withCount('wishList')
            ->where('slug', $slug)
            ->first();
        return $place;
    }
}
