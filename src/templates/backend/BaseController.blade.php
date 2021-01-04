<?="<?php

namespace " . $context->namespace['base_controller'] . ";

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use ReflectionClass; //a bit different dripada use class biasa...basically dye more to present/access blueprint of class
use Symfony\Component\HttpFoundation\Response;

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

    private function httpError()
    {
        \$httpErrorCode = new ReflectionClass(Response::class);
        return collect(\$httpErrorCode->getConstants())->values()->toArray();
    }

    public function success(\$message ,\$data = null)
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => \$message,
            'data' => \$data
        ]);
    }

    private function httpErrorMessage()
    {
        return collect(Response::\$statusTexts);
    }

    public function error(\Throwable \$th, \$response = null)
    {
        if (config(\"app.debug\")) {
            return response()->json([
                'success' => false,
                'code' => \$th->getCode(),
                'message' => \$th->getMessage()
            ]);
        }
        \$code = !empty(\$response['code']) ? \$response['code'] : \$th->getCode();
        if ( !in_array(\$code, \$this->httpErrorMessage()->keys()->toArray()) )
            \$code = 500;

        \$message = !empty(\$response['message']) ? \$response['message'] : \$this->httpErrorMessage()->get(\$code);
        return response()->json([
            'success' => false,
            'code' => \$code,
            'message' => \$message
        ]);
    }

    public function apiDoc() {
        return redirect('/api/documentation');
    }
}
"
?>