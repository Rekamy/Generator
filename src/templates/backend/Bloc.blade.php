<?=
"<?php

namespace App\Bloc;

use App\Contracts\Bloc\Concerns\CrudBloc;
use App\Repositories\\$repoName;
use App\Http\Requests\\$requestName;

class $className extends CrudBloc
{
    public function __construct($repoName \$repo, $requestName \$request)
    {
        \$this->repo = \$repo;
        \$this->request = \$request;
    }

    public static function permission(\$name) {
    //     \$permission = [
    //         'index' => '{$table}_index',
    //         'create' => '{$table}_create',
    //         'show' => '{$table}_show',
    //         'update' => '{$table}_update',
    //         'destroy' => '{$table}_destroy',
    //     ];
        
    //     return \$permission[\$name];
    }
}
"?>