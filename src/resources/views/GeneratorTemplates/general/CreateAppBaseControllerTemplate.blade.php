<?=
"<?php

namespace " . $context->namespace['app_base_controller'] . ";

use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use Illuminate\Http\Response as CoreResponse;

class AppBaseController extends Controller
{
    public function sendResponse(\$result, \$message)
    {
        return Response::json(ResponseUtil::makeResponse(\$message, \$result));
    }

    public function sendError(\$error, \$code = 404)
    {
        if (!array_key_exists(\$code, CoreResponse::\$statusTexts)) {
            \$code = 500;
        }

        \$error = app()->environment('local') ? \$error : CoreResponse::\$statusTexts[\$code];
        
        return Response::json(ResponseUtil::makeError(\$error), \$code);
    }
}
"
?>