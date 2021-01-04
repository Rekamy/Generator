<?=
"<?php

namespace App\Bloc;

use App\Bloc\Base\CrudBloc;
use Prettus\Repository\Contracts\RepositoryInterface;

class $className extends CrudBloc
{
    public function __construct(RepositoryInterface \$repo)
    {
        \$this->repo = \$repo;
    }
}
"?>
