<?= "
<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\Validator;

class ValidationException extends Exception
{

    /**
     * The underlying response instance.
     *
     * @var \Illuminate\Validation\Validator
     */
    protected Validator \$validation;

    /**
     * Create a new HTTP response exception instance.
     *
     * @param  \Illuminate\Validation\Validator  \$validator
     * @return void
     */
    public function __construct(Validator \$validator)
    {
        \$this->validation = \$validator;
        \$this->message = \"Validation Failed. Please make sure you fill it in correctly.\";
    }

    /**
     * Cast error to json response result.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse()
    {
        return response()->json([
            'success' => false,
            'message' => \$this->getMessage(),
            'data' => \$this->validation->errors()
        ], 422);
    }
}
" ?>
