<?php

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

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/country/{country}', function ($country){
   session()->put('country', $country);
   return back();
});

Route::domain(config('app.app_domain_name'))->group(function (){

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    /**
     * Frontend Router
     */
    Route::group([
        'namespace' => 'Frontend',
        'middleware' => []], function (){

        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/language/{locale}', 'HomeController@changeLanguage')->name('change_language');
        Route::get('/search', 'HomeController@search')->name('search');

        Route::get('/blog/all', 'PostController@list')->name('post_list_all');
        Route::get('/blog/{cat_slug}', 'PostController@list')->where('cat_slug', '[a-zA-Z0-9-_]+')->name('post_list');
        Route::get('/post/{slug}-{id}', 'PostController@detail')
            ->where('slug', '[a-zA-Z0-9-_]+')
            ->where('id', '[0-9]+')->name('post_detail');

        Route::get('/page/contact', 'HomeController@pageContact')->name('page_contact');
        Route::post('/page/contact', 'HomeController@sendContact')->name('page_contact_send');

        Route::get('/page/landing/{page_number}', 'HomeController@pageLanding')->name('page_landing');

        Route::get('/city/{slug}', 'CityController@detail')->name('city_detail');
        Route::get('/city/{slug}/{cat_slug}', 'CityController@detail')->name('city_category_detail');

        Route::get('/place/{slug}', 'PlaceController@detail')->name('place_detail');
        Route::get('/new-place', 'PlaceController@pageAddNew')->name('place_addnew');
        Route::get('/edit-place/{id}', 'PlaceController@pageAddNew')->name('place_edit')->middleware('auth');
        Route::post('/place', 'PlaceController@create')->name('place_create')->middleware('auth');
        Route::put('/place', 'PlaceController@update')->name('place_update')->middleware('auth');
        Route::get('/places/filter', 'PlaceController@getListFilter')->name('place_get_list_filter');

        Route::post('/review', 'ReviewController@create')->name('review_create')->middleware('auth');
        Route::post('/wishlist', 'UserController@addWishlist')->name('add_wishlist')->middleware('auth');
        Route::delete('/wishlist', 'UserController@removeWishlist')->name('remove_wishlist')->middleware('auth');

        Route::get('/user/profile', 'UserController@pageProfile')->name('user_profile')->middleware('auth');
        Route::put('/user/profile', 'UserController@updateProfile')->name('user_profile_update')->middleware('auth');
        Route::put('/user/profile/password', 'UserController@updatePassword')->name('user_password_update')->middleware('auth');
        Route::get('/user/reset-password', 'UserController@pageResetPassword')->name('user_reset_password');
        Route::put('/user/reset-password', 'ResetPasswordController@reset')->name('user_update_password');

        Route::get('/user/my-place', 'UserController@pageMyPlace')->name('user_my_place')->middleware('auth');
        Route::delete('/user/my-place', 'UserController@deleteMyPlace')->name('user_my_place_delete')->middleware('auth');

        Route::get('/user/wishlist', 'UserController@pageWishList')->name('user_wishlist')->middleware('auth');

        Route::post('/bookings', 'BookingController@booking')->name('booking_submit');

        Route::get('/auth/{social}', 'SocialAuthController@redirect')->name('login_social');
        Route::get('/auth/{social}/callback', 'SocialAuthController@callback')->name('login_social_callback');

        Route::get('/ajax-search', 'HomeController@ajaxSearch');
        Route::get('/ajax-search-listing', 'HomeController@searchListing');
        Route::get('/search', 'HomeController@search')->name('search');
        Route::get('/places/map', 'PlaceController@getListMap')->name('place_get_list_map');

        Route::get('/cities/{country_id}', 'CityController@getListByCountry')->name('city_get_list');
        Route::get('/cities', 'CityController@search')->name('city_search');

        Route::get('/search-listing-input', 'HomeController@searchListing')->name('search_listing');
        Route::get('/search-listing', 'HomeController@pageSearchListing')->name('page_search_listing');
        Route::get('/category/{slug}', 'CategoryController@listPlace')->name('category_list');
        Route::get('/categories', 'CategoryController@search')->name('category_search');

    });

    /*
     * AdminCP Router
     */
    Route::group([
        'prefix' => 'admincp',
        'namespace' => 'Admin',
        'as' => 'admin_',
        'middleware' => ['auth', 'auth.admin']], function (){

        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::get('/country', 'CountryController@list')->name('country_list');
        Route::post('/country', 'CountryController@create')->name('country_create');
        Route::put('/country', 'CountryController@update')->name('country_update');
        Route::delete('/country/{id}', 'CountryController@destroy')->name('country_delete');

        Route::get('/city', 'CityController@list')->name('city_list');
        Route::post('/city', 'CityController@create')->name('city_create');
        Route::put('/city', 'CityController@update')->name('city_update');
        Route::put('/city/status', 'CityController@updateStatus')->name('city_update_status');
        Route::delete('/city/{id}', 'CityController@destroy')->name('city_delete');

        Route::get('/category/{type}', 'CategoryController@list')->name('category_list');
        Route::post('/category', 'CategoryController@create')->name('category_create');
        Route::put('/category', 'CategoryController@update')->name('category_update');
        Route::delete('/category/{id}', 'CategoryController@destroy')->name('category_delete');

        Route::get('/amenities', 'AmenitiesController@list')->name('amenities_list');
        Route::post('/amenities', 'AmenitiesController@create')->name('amenities_create');
        Route::put('/amenities', 'AmenitiesController@update')->name('amenities_update');
        Route::delete('/amenities/{id}', 'AmenitiesController@destroy')->name('amenities_delete');

        Route::get('/place-type', 'PlaceTypeController@list')->name('place_type_list');
        Route::post('/place-type', 'PlaceTypeController@create')->name('place_type_create');
        Route::put('/place-type', 'PlaceTypeController@update')->name('place_type_update');
        Route::delete('/place-type/{id}', 'PlaceTypeController@destroy')->name('place_type_delete');

        Route::get('/place', 'PlaceController@list')->name('place_list');
        Route::get('/place/add', 'PlaceController@createView')->name('place_create_view');
        Route::get('/place/edit/{id}', 'PlaceController@createView')->name('place_edit_view');
        Route::post('/place', 'PlaceController@create')->name('place_create');
        Route::put('/place', 'PlaceController@update')->name('place_update');
        Route::delete('/place/{id}', 'PlaceController@destroy')->name('place_delete');

        Route::get('/review', 'ReviewController@list')->name('review_list');
        Route::delete('/review', 'ReviewController@destroy')->name('review_delete');

        Route::get('/users', 'UserController@list')->name('user_list');

        Route::get('/blog', 'PostController@list')->name('post_list_blog');
        Route::get('/pages', 'PostController@list')->name('post_list_page');

        Route::get('/posts/add/{type}', 'PostController@pageCreate')->name('post_add');
        Route::get('/posts/{id}', 'PostController@pageCreate')->name('post_edit');
        Route::post('/posts', 'PostController@create')->name('post_create');
        Route::put('/posts', 'PostController@update')->name('post_update');
        Route::delete('/posts/{id}', 'PostController@destroy')->name('post_delete');

        Route::get('/post-test', 'PostController@createPostTest');
        Route::get('/language/copy-folder', 'LanguageController@testCopyFolder');

        Route::get('/bookings', 'BookingController@list')->name('booking_list');
        Route::put('/bookings', 'BookingController@updateStatus')->name('booking_update_status');

        Route::get('/settings', 'SettingController@index')->name('settings');
        Route::post('/settings', 'SettingController@store')->name('setting_create');

        Route::get('/settings/language', 'SettingController@pageLanguage')->name('settings_language');
        Route::get('/settings/translation', 'SettingController@pageTranslation')->name('settings_translation');

        Route::put('/settings/language/status/{code}', 'LanguageController@updateStatus')->name('settings_language_status');
        Route::put('/settings/language/default', 'LanguageController@updateStatus')->name('settings_language_default');


        Route::get('/upgrade-to-v110', 'UpgradeController@upgradeToVersion110')->name('upgrade_v110');
        Route::get('/upgrade-to-v112', 'UpgradeController@upgradeToVersion112')->name('upgrade_v112');
        Route::get('/upgrade-to-v114', 'UpgradeController@upgradeToVersion114')->name('upgrade_v114');


        Route::get('/testimonials', 'TestimonialController@list')->name('testimonial_list');
        Route::get('/testimonials/add', 'TestimonialController@pageCreate')->name('testimonial_page_add');
        Route::get('/testimonials/edit/{id}', 'TestimonialController@pageCreate')->name('testimonial_page_edit');
        Route::post('/testimonials', 'TestimonialController@create')->name('testimonial_action');
        Route::put('/testimonials', 'TestimonialController@update')->name('testimonial_action');

    });

    Route::get('/admincp/login', 'Admin\UserController@loginPage')->name('admin_login');

});

