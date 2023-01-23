<?="<?php

namespace App\Contracts\Bloc\Concerns;

trait CrudableBloc
{

    public function index(\$input)
    {
        return \$this->repo->indexAction(\$input)->toArray();
    }

    public function store(\$input)
    {
        return \$this->repo->storeAction(\$input);
    }

    public function show(\$id)
    {
        return \$this->repo->showAction(\$id);
    }

    public function update(\$id, \$input)
    {
        return \$this->repo->updateAction(\$id, \$input);
    }

    public function destroy(\$id)
    {
        return \$this->repo->destroyAction(\$id);
    }
}
"
?>
