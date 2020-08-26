<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::get('/locale/{locale}',function ($locale){
    Session::put('language_code', $locale);
    Session::put('locale', $locale);
    app()->setLocale($locale);
    return redirect()->back();
})->name('locale');


Route::domain('find.'.config('app.app_domain_name'))->group(function (){

    Route::group(['namespace'=>'Frontend'], function(){
       Route::get('/', 'JobController@index');
    });

});
