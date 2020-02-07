<?=
"<?php

namespace " . $context->namespace['app_base_controller'] . ";

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

class AppBaseController extends Controller
{
    public function sendResponse(\$result, \$message)
    {
        return Response::json(ResponseUtil::makeResponse(\$message, \$result));
    }

    public function sendError(\$error, \$code = 404)
    {
        return Response::json(ResponseUtil::makeError(\$error), \$code);
    }
}
"
?>