<?php

use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

$router->group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

/**
 * Frontend Router
 */
$router->group([
    'namespace' => 'Frontend',
    'middleware' => []
], function () use ($router) {

    $router->get('/', 'HomeController@index')->name('home');


    $router->post('/subscribe', 'HomeController@write')->name('subscribe');

    $router->get('/page/landing/{page_number}', 'HomeController@pageLanding')->name('page_landing');


    $router->get('/auth/{social}', 'SocialAuthController@redirect')->name('login_social');
    $router->get('/auth/{social}/callback', 'SocialAuthController@callback')->name('login_social_callback');
});

/*
 * AdminCP Router
 */
$router->group([
    'prefix' => 'admincp',
    'namespace' => 'Admin',
    'as' => 'admin_',
    'middleware' => ['auth', 'auth.admin']
], function () use ($router) {

    $router->get('/', 'DashboardController@index')->name('dashboard');

    $router->get('/country', 'CountryController@list')->name('country_list');
    $router->post('/country', 'CountryController@create')->name('country_create');
    $router->put('/country', 'CountryController@update')->name('country_update');
    $router->delete('/country/{id}', 'CountryController@destroy')->name('country_delete');

    $router->get('/city', 'CityController@list')->name('city_list');
    $router->post('/city', 'CityController@create')->name('city_create');
    $router->put('/city', 'CityController@update')->name('city_update');
    $router->put('/city/status', 'CityController@updateStatus')->name('city_update_status');
    $router->delete('/city/{id}', 'CityController@destroy')->name('city_delete');

    $router->get('/category/{type}', 'CategoryController@list')->name('category_list');
    $router->post('/category', 'CategoryController@create')->name('category_create');
    $router->put('/category', 'CategoryController@update')->name('category_update');
    $router->delete('/category/{id}', 'CategoryController@destroy')->name('category_delete');

    $router->get('/amenities', 'AmenitiesController@list')->name('amenities_list');
    $router->post('/amenities', 'AmenitiesController@create')->name('amenities_create');
    $router->put('/amenities', 'AmenitiesController@update')->name('amenities_update');
    $router->delete('/amenities/{id}', 'AmenitiesController@destroy')->name('amenities_delete');

    $router->get('/tfeatures', 'TfeaturesController@list')->name('tfeatures_list');
    $router->post('/tfeatures', 'TfeaturesController@create')->name('tfeatures_create');
    $router->put('/tfeatures', 'TfeaturesController@update')->name('tfeatures_update');
    $router->delete('/tfeatures/{id}', 'TfeaturesController@destroy')->name('tfeatures_delete');


    $router->get('/place-type', 'PlaceTypeController@list')->name('place_type_list');
    $router->post('/place-type', 'PlaceTypeController@create')->name('place_type_create');
    $router->put('/place-type', 'PlaceTypeController@update')->name('place_type_update');
    $router->delete('/place-type/{id}', 'PlaceTypeController@destroy')->name('place_type_delete');

    $router->get('/place', 'PlaceController@list')->name('place_list');
    $router->get('/place/add', 'PlaceController@createView')->name('place_create_view');
    $router->get('/place/edit/{id}', 'PlaceController@createView')->name('place_edit_view');
    $router->post('/place', 'PlaceController@create')->name('place_create');
    $router->put('/place', 'PlaceController@update')->name('place_update');
    $router->delete('/place/{id}', 'PlaceController@destroy')->name('place_delete');

    $router->get('/transport', 'TransportController@list')->name('transport_list');
    $router->get('/transport/add', 'TransportController@createView')->name('transport_create_view');
    $router->get('/transport/edit/{id}', 'TransportController@createView')->name('transport_edit_view');
    $router->post('/transport', 'TransportController@create')->name('transport_create');
    $router->put('/transport', 'TransportController@update')->name('transport_update');
    $router->delete('/transport/{id}', 'TransportController@destroy')->name('transport_delete');

    $router->get('/stores', 'StoreController@list')->name('store_list');
    $router->get('/stores/add', 'StoreController@createView')->name('store_create_view');
    $router->get('/stores/edit/{id}', 'StoreController@createView')->name('store_edit_view');
    $router->post('/stores', 'StoreController@create')->name('store_create');
    $router->put('/stores', 'StoreController@update')->name('store_update');
    $router->delete('/stores/{id}', 'StoreController@destroy')->name('store_delete');


    $router->get('/products', 'ProductController@list')->name('product_list');
    $router->get('/products/add', 'ProductController@createView')->name('product_create_view');
    $router->get('/products/edit/{id}', 'ProductController@createView')->name('product_edit_view');
    $router->post('/products', 'ProductController@create')->name('product_create');
    $router->put('/products', 'ProductController@update')->name('product_update');
    $router->delete('/products/{id}', 'ProductController@destroy')->name('product_delete');


    $router->get('/features', 'TfeaturesController@list')->name('features_list');
    $router->post('/features', 'TfeaturesController@create')->name('features_create');
    $router->put('/features', 'TfeaturesController@update')->name('features_update');
    $router->delete('/features/{id}', 'TfeaturesController@destroy')->name('features_delete');

    $router->get('/event', 'EventController@list')->name('event_list');
    $router->get('/event/add', 'EventController@createView')->name('event_create_view');
    $router->get('/event/edit/{id}', 'EventController@createView')->name('event_edit_view');
    $router->post('/event', 'EventController@create')->name('event_create');
    $router->put('/event', 'EventController@update')->name('event_update');
    $router->delete('/event/{id}', 'EventController@destroy')->name('event_delete');

    $router->get('/review', 'ReviewController@list')->name('review_list');
    $router->delete('/review', 'ReviewController@destroy')->name('review_delete');

    $router->get('/treview', 'TReviewController@list')->name('treview_list');
    $router->delete('/treview', 'TReviewController@destroy')->name('review_delete');

    $router->get('/users', 'UserController@list')->name('user_list');

    $router->get('/blog', 'PostController@list')->name('post_list_blog');
    $router->get('/pages', 'PostController@list')->name('post_list_page');

    $router->get('/posts/add/{type}', 'PostController@pageCreate')->name('post_add');
    $router->get('/posts/{id}', 'PostController@pageCreate')->name('post_edit');
    $router->post('/posts', 'PostController@create')->name('post_create');
    $router->put('/posts', 'PostController@update')->name('post_update');
    $router->delete('/posts/{id}', 'PostController@destroy')->name('post_delete');

    $router->get('/post-test', 'PostController@createPostTest');
    $router->get('/language/copy-folder', 'LanguageController@testCopyFolder');

    $router->get('/bookings', 'BookingController@list')->name('booking_list');
    $router->put('/bookings', 'BookingController@updateStatus')->name('booking_update_status');


    $router->get('/journies', 'JourneyController@list')->name('journey_list');
    $router->put('/journies', 'JourneyController@updateStatus')->name('journey_update_status');


    $router->get('/settings', 'SettingController@index')->name('settings');
    $router->post('/settings', 'SettingController@store')->name('setting_create');

    $router->get('/settings/language', 'SettingController@pageLanguage')->name('settings_language');
    $router->get('/settings/translation', 'SettingController@pageTranslation')->name('settings_translation');

    $router->put('/settings/language/status/{code}', 'LanguageController@updateStatus')->name('settings_language_status');
    $router->put('/settings/language/default', 'LanguageController@updateStatus')->name('settings_language_default');


    $router->get('/upgrade-to-v110', 'UpgradeController@upgradeToVersion110')->name('upgrade_v110');
    $router->get('/upgrade-to-v112', 'UpgradeController@upgradeToVersion112')->name('upgrade_v112');
    $router->get('/upgrade-to-v114', 'UpgradeController@upgradeToVersion114')->name('upgrade_v114');
    $router->get('/upgrade-to-v119', 'UpgradeController@upgradeToVersion119')->name('upgrade_v119');


    $router->get('/testimonials', 'TestimonialController@list')->name('testimonial_list');
    $router->get('/testimonials/add', 'TestimonialController@pageCreate')->name('testimonial_page_add');
    $router->get('/testimonials/edit/{id}', 'TestimonialController@pageCreate')->name('testimonial_page_edit');
    $router->post('/testimonials', 'TestimonialController@create')->name('testimonial_action');
    $router->put('/testimonials', 'TestimonialController@update')->name('testimonial_action');
    $router->delete('/testimonials/{id}', 'TestimonialController@destroy')->name('testimonial_destroy');
});

$router->get('/admincp/login', 'Admin\UserController@loginPage')->name('admin_login');
