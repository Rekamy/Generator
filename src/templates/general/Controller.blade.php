<?=
"<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\CrudController;
use App\Bloc\\$blocName;

class $className extends CrudController
{
    protected \$baseBloc;
    protected \$moduleName = '';
    private \$result;

    public function __construct($blocName \$bloc) 
    {
        \$this->baseBloc = \$bloc;
        \$this->moduleName = '$table';
    }
}
"?>