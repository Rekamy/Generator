<?="<?php

namespace " . $context->namespace['base_controller'] . ";

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
    * @OA\Info(
    *     description=\"" . $context->appName . " API Documentation\",
    *     version=\"1.0.0\",
    *     title=\"" . $context->appName . " API Documentation\",
    * )
    */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
"
?>