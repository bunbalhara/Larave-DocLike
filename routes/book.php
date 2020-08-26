<?php

use Illuminate\Support\Facades\Route;


Route::domain('book.'.config('app.app_domain_name'))->group(function (){

    Route::group(['namespace'=>'Book'], function(){
        Route::get('/', 'HomeController@index');
    });

});
