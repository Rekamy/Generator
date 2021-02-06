<?="<?php

namespace " . $context->namespace['base_controller'] . ";

use App\Exceptions\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use ReflectionClass; //a bit different dripada use class biasa...basically dye more to present/access blueprint of class
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function httpError()
    {
        \$httpErrorCode = new ReflectionClass(Response::class);
        return collect(\$httpErrorCode->getConstants())->values()->toArray();
    }

    public function success(\$message, \$data = null)
    {
        return response()->json([
            'message' => \$message,
            'data' => \$data
        ], 200);
    }

    private function httpErrorMessage()
    {
        return collect(Response::\$statusTexts);
    }

    public function error(\Throwable \$th, \$response = null)
    {
        // if (config(\"app.debug\")) {
        //     return response()->json([
        //         'message' => \$th->getMessage()
        //     ], 500);
        // }

        if (\$th instanceof ValidationException) return \$th->toResponse();

        \$code = !empty(\$response['code']) ? \$response['code'] : \$th->getCode();
        if ( !in_array(\$code, \$this->httpErrorMessage()->keys()->toArray()) )
            \$code = 500;

        \$message = !empty(\$response['message']) ? \$response['message'] : \$this->httpErrorMessage()->get(\$code);
        return response()->json([
            'message' => \$message
        ], \$code);
    }

    public function apiDoc()
    {
        return redirect('/api/documentation');
    }
}
"
?>