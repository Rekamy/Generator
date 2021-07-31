<?= "
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
" ?>
<?php 
  foreach($routes as $route):
    echo "use App\Http\Controllers\\{$route['className']};\n";
  endforeach;
?>

<?= "


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
<?php foreach ($routes as $route) { ?>
<?= "
    '" . $route['routeName']  . "' => '". $route['className'] ."',
" ?>
<?php } ?>
<?= "]);" ?>