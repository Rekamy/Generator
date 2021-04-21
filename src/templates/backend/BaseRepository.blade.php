<?="<?php

namespace App\Contracts\Overrides;

use Prettus\Repository\Eloquent\BaseRepository as PreetusBaseRepository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class BaseRepository
 * @package Prettus\Repository\Eloquent
 * @author Anderson Andrade <contato@andersonandra.de>
 */
abstract class BaseRepository extends PreetusBaseRepository implements RepositoryInterface, RepositoryCriteriaInterface
{
    /**
     * @param Application \$app
     */
    public function __construct(Application \$app, Request \$request)
    {
        \$this->app = \$app;
        \$this->request = \$request;
        \$this->criteria = new Collection();
        \$this->makeModel();
        \$this->makeValidator();
        \$this->boot();
    }

    /**
     * !!IMPORTANT Do not remove
     * Override reset Model method
     *
     * @throws RepositoryException
     */
    public function resetModel()
    {
        /**
         * !!IMPORTANT Do not uncomment
         */

        // \$this->makeModel();
    }

    /**
     * @throws RepositoryException
     */
    public function forceResetModel()
    {
        \$this->makeModel();
    }

    /**
     * Wrapper result data
     *
     * @param mixed \$result
     *
     * @return mixed
     */
    public function parserResult(\$result)
    {
        if (\$result instanceof LengthAwarePaginator) {
            \$result->getCollection()->transform(function (\$model) {
                return \$this->applyModelStructure(\$model);
            });
        }

        if (\$result instanceof Model) {
            \$result = \$this->applyModelStructure(\$result);
        }

        \$this->forceResetModel();

        return \$result;
    }

    private function applyModelStructure(\$model)
    {
        \$modelStructure = \$this->getModel();

        if (\$modelStructure instanceof Builder) {
            \$modelStructure = \$modelStructure->getModel();
        }

        if (\$modelStructure instanceof Model && \$modelStructure->appends) {
            \$model->setAppends(\$modelStructure->appends);
        }
        return \$model;
    }
}
"
?>
