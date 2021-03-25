<?="<?php

namespace App\Contracts\Repositories\Concerns;

use App\Contracts\Criteria\DataTableCriteria;
use Prettus\Repository\Criteria\RequestCriteria;

trait CrudableRepository
{
    public function indexAction(\$input)
    {
        if (!empty(\$input['draw'])) {
            \$this->pushCriteria(app(DataTableCriteria::class));
        } else {
            \$this->pushCriteria(app(RequestCriteria::class));
            return \$this->paginate();
        }

        return \$this;
    }

    public function storeAction(\$input)
    {
        if (!\$result = \$this->create(\$input))
            throw new Exception('Error Processing Request', 422);

        return \$result;
    }

    public function showAction(\$id)
    {
        if (!\$result = \$this->find(\$id))
            throw new Exception('Error Processing Request', 422);

        return \$result;
    }

    public function updateAction(\$id, \$input)
    {
        if (!\$result = \$this->update(\$input, \$id))
            throw new Exception('Error Processing Request', 422);

        return \$result;
    }

    public function destroyAction(\$id)
    {
        if (!\$result = \$this->delete(\$id))
            throw new Exception('Error Processing Request', 422);

        return \$result;
    }
}
"
?>