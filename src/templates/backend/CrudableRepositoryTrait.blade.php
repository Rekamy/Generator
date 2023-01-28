<?="<?php

namespace App\Contracts\Repositories\Concerns;

use App\Contracts\Criteria\DataTableCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Criteria\RequestExtensionCriteria;

trait CrudableRepository
{
    public function indexAction(\$input)
    {
        if (!empty(\$input['draw'])) {
            \$this->pushCriteria(app(DataTableCriteria::class));
        } else {
            \$this->pushCriteria(app(RequestCriteria::class));
            \$this->pushCriteria(app(RequestExtensionCriteria::class));
            if (!request()->has('no-paginate')) return \$this->paginate();
            return \$this->get();
        }

        return \$this;
    }

    public function storeAction(\$input)
    {
        if (!\$result = \$this->createWithRelation(\$input))
            throw new Exception('Error Processing Request', 422);

        return \$result;
    }

    public function showAction(\$id)
    {
        \$this->pushCriteria(app(RequestCriteria::class));
        \$this->pushCriteria(app(RequestExtensionCriteria::class));
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
