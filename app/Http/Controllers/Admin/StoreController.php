<?php

namespace App\Http\Controllers\Admin;


use App\Commons\Response;
use App\Http\Controllers\Controller;

use App\Models\City;
use App\Models\Country;
use App\Models\Amenities;
use App\Models\Store;
use App\Models\Store_cat;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    private $store;
    private $country;
    private $city;
    private $store_category;
    private $amenities;
    private $response;

    public function __construct(
        Store $store,
        Country $country,
        City $city,
        Store_cat $store_category,
        Response $response
    ) {
        $this->store = $store;
        $this->country = $country;
        $this->city = $city;
        $this->store_category = $store_category;
        $this->response = $response;
    }

    public function list(Request $request)
    {
        $param_country_id = $request->country_id;
        $param_city_id = $request->city_id;
        $param_cat_id = $request->category_id;

        $stores = $this->store->listByFilter($param_country_id, $param_city_id, $param_cat_id);
        $countries = $this->country->getFullList();
        $cities = $this->city->getListByCountry($param_country_id);
        $categories = $this->store_category->getListAll();

        //        return $places;

        return view('admin.store.store_list', [
            'stores' => $stores,
            'countries' => $countries,
            'country_id' => (int)$param_country_id,
            'cities' => $cities,
            'city_id' => (int)$param_city_id,
            'categories' => $categories,
            'cat_id' => (int)$param_cat_id,
        ]);
    }

    public function createView(Request $request)
    {
        $store = Store::find($request->id);
        $country_id = $store ? $store->country_id : false;

        $countries = $this->country->getFullList();
        $categories = $this->category->getListAll();
        $cities = $this->city->getListByCountry($country_id);



        $amenities = $this->amenities->getListAll();

        //        return $place;

        return view('admin.place.place_create', compact('countries', 'cities', 'categories', 'place_types', 'amenities', 'place'));
    }

    public function create(Request $request)
    {
        $request['user_id'] = Auth::id();
        $request['slug'] = getSlug($request, 'name');
        $rule_factory = RuleFactory::make([
            'user_id' => '',
            'country_id' => '',
            'city_id' => '',
            'category' => '',
            'place_type' => '',
            '%name%' => '',
            'slug' => '',
            '%description%' => '',
            'price_range' => '',
            'amenities' => '',
            'address' => '',
            'lat' => '',
            'lng' => '',
            'email' => '',
            'phone_number' => '',
            'website' => '',
            'social' => '',
            'opening_hour' => '',
            'gallery' => '',
            'video' => '',
            'booking_type' => '',
            'link_bookingcom' => '',
            'thumb' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'seo_title' => '',
            'seo_description' => '',
            'menu' => '',
            'faq' => '',
        ]);
        $data = $this->validate($request, $rule_factory);

        if (!isset($data['social'])) {
            $data['social'] = null;
        }

        if (!isset($data['menu'])) {
            $data['menu'] = null;
        }

        if (!isset($data['faq'])) {
            $data['faq'] = null;
        }

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }

        $model = new Store();
        $model->fill($data);

        if ($model->save()) {
            return redirect(route('admin_place_list'))->with('success', 'Create place success!');
        }
    }

    public function update(Request $request)
    {
        $request['slug'] = getSlug($request, 'name');
        $rule_factory = RuleFactory::make([
            'country_id' => '',
            'city_id' => '',
            'category' => '',
            'place_type' => '',
            '%name%' => '',
            'slug' => '',
            '%description%' => '',
            'price_range' => '',
            'amenities' => '',
            'address' => '',
            'lat' => '',
            'lng' => '',
            'email' => '',
            'phone_number' => '',
            'website' => '',
            'social' => '',
            'opening_hour' => '',
            'gallery' => '',
            'video' => '',
            'booking_type' => '',
            'link_bookingcom' => '',
            'thumb' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'seo_title' => '',
            'seo_description' => '',
            'menu' => '',
            'faq' => '',
        ]);
        $data = $this->validate($request, $rule_factory);

        if (!isset($data['social'])) {
            $data['social'] = null;
        }

        if (!isset($data['menu'])) {
            $data['menu'] = null;
        }

        if (!isset($data['faq'])) {
            $data['faq'] = null;
        }

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }

        $model = Store::find($request->place_id);
        $model->fill($data);

        if ($model->save()) {
            return redirect(route('admin_place_list'))->with('success', 'Update place success!');
        }
    }

    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        $model = Store::find($request->place_id);
        $model->fill($data)->save();

        return $this->response->formatResponse(200, $model, 'Update place status success!');
    }

    public function destroy($id)
    {
        Store::destroy($id);
        return back()->with('success', 'Delete place success!');
    }
}
