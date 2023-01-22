<?=
"<?php

namespace " . $context->config->setup->backend->controller->namespace . ";

use App\Http\Controllers\Base\CrudController;
use App\Bloc\\$blocName;

class $className extends CrudController
{
    protected \$baseBloc;
    protected \$moduleName = '';
    private \$result;

    public function __construct($blocName \$bloc) 
    {
        // \$this->registerPassportScopes();
        \$this->baseBloc = \$bloc;
        \$this->moduleName = '$table';
    }

    public function registerPassportScopes()
    {
        \$this->middleware('scope:{$snake}_index')->only('index');
        \$this->middleware('scope:{$snake}_create')->only('store');
        \$this->middleware('scope:{$snake}_show')->only('show');
        \$this->middleware('scope:{$snake}_update')->only('update');
        \$this->middleware('scope:{$snake}_destroy')->only('destroy');
    }
}
"?>
