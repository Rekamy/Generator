<?php

Route::group(['namespace' => 'Rekamy\ApiGenerator\Http\Controllers'], function () {
    Route::get('generator', 'ApiGeneratorController@index')->name('generator');
});
