<?= "
<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\Validator;
use Illuminate\Validation\ValidationException as BaseException;

class ValidationException extends BaseException
{
    /**
     * The message response to send to the client.
     *
     * @var string|null
     */
    public \$message;

    /**
     * Override Validation Exception instance.
     *
     * @param  \Illuminate\Validation\Validator  \$validator
     * @return void
     */
    public function __construct(Validator \$validator, string \$message = null)
    {
        parent::__construct(\$validator);

        \$this->setMessage(\$message);

        \$this->setResponse();
    }

    /**
     * Make json response result.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function setResponse()
    {
        \$this->response =  response()->json([
            'message' => \$this->getMessage(),
            'data' => \$this->validator->errors()->messages()
        ], 422);
    }

    public function setMessage(\$message)
    {
        \$message = 'Validation Failed. Please make sure you fill it in correctly.';

        \$this->message = \$message ?? \$this->message;
    }
}
" ?>