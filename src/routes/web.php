<?php

Route::group(['namespace' => 'Rekamy\Generator\Http\Controllers'], function () {
    Route::get('generator', 'ApiGeneratorController@index');
    Route::get('logout', 'ApiGeneratorController@index');
});
