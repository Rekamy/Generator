<?="<?php

namespace App\Contracts\Bloc\Concerns;

use App\Contracts\Requests\RequestInterface;

trait HasRequest
{
    public function registerRequest(RequestInterface \$request)
    {
        \$this->request = \$request;
    }

    public function getRequest()
    {
        return \$this->request;
    }

}
"
?>