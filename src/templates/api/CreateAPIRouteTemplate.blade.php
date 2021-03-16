<?= "
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
" ?>
<?php 
  foreach($className as $key => $class):
    echo "use App\Http\Controllers\\$class;\n";
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
<?=
"Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']); 
" ?>

<?= "Route::apiResources([" ?>
<?php foreach ($className as $key => $class) { ?>
    <?php foreach ($slug as $key => $name) { ?>
        <?= "
    '" . $name . "' => '" . $class . "',
" ?>
    <?php } ?>
<?php } ?>
<?= "]);" ?>