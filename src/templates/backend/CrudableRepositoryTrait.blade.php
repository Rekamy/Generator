<?="<?php

namespace App\Contracts\Repositories\Concerns;

use Illuminate\Pagination\Paginator;

trait CrudableRepository
{

    public function pushRequestCriteria(\$input)
    {
        if (empty(\$input['start'])) {
            \$input['start'] = 0;
        }

        if (empty(\$input['length'])) {
            \$input['length'] = 10;
        }
        return \$input;
    }

    public function resolvePagination(\$input)
    {
        Paginator::currentPageResolver(function () use (\$input) {
            return (\$input['start'] / \$input['length'] + 1);
        });
    }

    public function indexAction(\$input)
    {
        \$input = \$this->pushRequestCriteria(\$input);
        \$this->resolvePagination(\$input);

        \$model = \$this;

        if (!empty(\$input['search']['value'])) {
            foreach (\$this->fieldSearchable as \$column) {
                \$model = \$model->whereLike(\$column, \$input['search']['value']);
            }
        }

        return \$model->paginate(\$input['length']);
    }

    public function storeAction(\$input)
    {
        if (!\$result = \$this->create(\$input))
            throw new Exception('Error Processing Request', 405);

        return \$result;
    }

    public function showAction(\$id)
    {
        if (!\$result = \$this->find(\$id))
            throw new Exception('Error Processing Request', 405);

        return \$result;
    }

    public function updateAction(\$id, \$input)
    {
        if (!\$result = \$this->update(\$input, \$id))
            throw new Exception('Error Processing Request', 405);

        return \$result;
    }

    public function destroyAction(\$id)
    {
        if (!\$result = \$this->delete(\$id))
            throw new Exception('Error Processing Request', 405);

        return \$result;
    }
}
"
?>