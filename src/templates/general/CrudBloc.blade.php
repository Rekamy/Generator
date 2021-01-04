<?="<?php

namespace App\Bloc\Base;

use App\Contracts\Bloc\Concerns\CrudableBloc;
use App\Contracts\Bloc\Concerns\HasRepository;
use App\Contracts\Bloc\Concerns\HasRequest;
use App\Contracts\Bloc\CrudBlocInterface;

abstract class CrudBloc implements CrudBlocInterface
{
    use HasRepository, HasRequest, CrudableBloc;

    protected \$moduleName;

    public function permission(\$name) {
        \$permission = [
            'index' => \$this->moduleName . '_index',
            'create' => \$this->moduleName . '_create',
            'show' => \$this->moduleName . '_show',
            'update' => \$this->moduleName . '_update',
            'destroy' => \$this->moduleName . '_destroy',
        ];

        return \$permission[\$name];
    }
}
"
?>