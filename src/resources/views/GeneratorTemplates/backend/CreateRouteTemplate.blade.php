<?= "
<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the \"api\" middleware group. Enjoy building your API!
|
*/

" ?>
<?= "Route::apiResources([" ?>
<?php foreach ($db->tables as $table) { ?>
<?= "
    '" . lcfirst(Str::singular(str_replace('_', '', $table->TABLE_NAME))) . "' => '" . ucfirst(Str::camel(Str::singular($table->TABLE_NAME))) . "APIController@index',
" ?>
<?php } ?>
<?= "]);" ?>