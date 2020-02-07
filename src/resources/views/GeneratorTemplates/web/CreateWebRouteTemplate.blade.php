<?= "
<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the \"web\" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

" ?>
<?= "Route::resources([" ?>
<?php foreach ($db->tables as $table) { ?>
<?= "
    '" . lcfirst(Str::singular(str_replace('_', '', $table->TABLE_NAME))) . "' => '" . ucfirst(Str::camel(Str::singular($table->TABLE_NAME))) . "Controller',
" ?>
<?php } ?>
<?= "]);" ?>