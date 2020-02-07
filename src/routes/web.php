<?php

Route::group(['namespace' => 'Rekamy\Generator\Http\Controllers'], function () {
    Route::get('generator', 'ApiGeneratorController@index')->name('generator');
    Route::get('dashboard', 'ApiGeneratorController@index')->name('dashboard');
    Route::get('logout', 'ApiGeneratorController@index')->name('logout');
});
