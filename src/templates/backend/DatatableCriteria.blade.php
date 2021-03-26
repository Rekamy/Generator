<?="<?php

namespace App\Contracts\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class DataTableCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected \$request;
    protected \$query;
    protected \$columns;

    public function __construct(Request \$request)
    {
        \$this->request = \$request;
    }

    public function resolvePagination()
    {
        LengthAwarePaginator::currentPageResolver(function () {
            return \$this->request->get('start') / \$this->request->get('length') + 1;
        });
    }

    /**
     * Apply criteria in query repository
     *
     * @param         Builder|Model     \$model
     * @param RepositoryInterface \$repository
     *
     * @return mixed
     * @throws \Exception
     */
    public function apply(\$model, RepositoryInterface \$repository)
    {
        \$this->query = \$model;
        \$this->repository = \$repository;

        if (!\$this->request->has('columns')) throw new Exception('Column does not set', 400);
        
        \$this->columns = collect(\$this->request->get('columns'))
            ->map(function (\$value, \$index) {
                \$value['index'] = \$index;
                return \$value;
            });

        if (\$this->isPaginationable()) \$this->resolvePagination();


        \$this->applyFilter();

        return \$this->query->paginate(\$this->request->get('length'));
    }

    public function applyFilter()
    {
        if (\$this->request->has('search')) {
            \$keyword = \$this->request->get('search');
            \$dtSearchable = \$this->columns->where('searchable', 'true')->pluck('data')->toArray();
            \$searchable = array_intersect(\$this->repository->getFieldsSearchable(), \$dtSearchable);
            \$this->query = \$this->query->search(\$searchable, \$keyword['value']);
        }

        if (\$this->request->has('order')) {
            \$orders = \$this->request->get('order');
            \$columns = \$this->columns->toArray();
            foreach (\$orders as \$value) {
                \$index = \$value['column'];
                \$sort = \$value['dir'];
                if (!empty(\$columns[\$index]['data'])) {
                    \$this->query = \$this->query->orderBy(\$columns[\$index]['data'], \$sort);
                }
            }
        }
    }
    /**
     * Check if Request allow pagination.
     *
     * @return bool
     */
    public function isPaginationable()
    {
        return !is_null(\$this->request->input('start')) &&
            !is_null(\$this->request->input('length')) &&
            \$this->request->input('length') != -1;
    }
}
"
?>