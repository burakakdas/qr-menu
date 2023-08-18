<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(), 'middleware' => ['localizationRedirect']], function ()
{
    Route::get('/', function () {
        return ['Laravel' => app()->version()];
    });
});
