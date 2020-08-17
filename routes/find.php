<?php

use Illuminate\Support\Facades\Route;



Route::get('/locale/{locale}',function ($locale){
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');


Route::domain('find.'.config('app.app_domain_name'))->group(function (){

    Route::group(['namespace'=>'Frontend'], function(){
       Route::get('/', 'JobController@index');
    });

    Route::prefix('api')->group(function (){
        Route::post('get-appointment', 'Appointment\JobController@getAppointment');
        Route::get('get-categories', 'Appointment\JobController@getCategories');
        Route::get('get-current-user', 'Appointment\JobController@getCurrentUser');
        Route::post('save-post', 'Appointment\JobController@savePost');
        Route::post('get-offers', 'Appointment\JobController@getOffers');
        Route::post('/get-map-routes', 'Appointment\JobController@getMapRoutes');
    });

});
