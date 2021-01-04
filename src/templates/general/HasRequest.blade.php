<?="<?php

namespace App\Contracts\Bloc\Concerns;

use App\Contracts\Requests\CrudRequestInterface;

trait HasRequest
{
    public function registerRequest(CrudRequestInterface \$request)
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