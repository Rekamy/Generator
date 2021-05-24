<?= "<?php

namespace App\Contracts\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Exception;

class DataTableCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected \$request;
    protected \$resources;
    protected \$appends;
    protected \$query;
    protected \$columns;

    public function __construct(Request \$request)
    {
        \$this->request = \$request;
        \$this->appends = collect();
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


        \$this->loadAnyRelation();
        \$this->applyQueryScope();

        if (\$this->isPaginationable()) \$this->resolvePagination();

        \$this->applyFilter();

        \$this->buildResources();


        return \$this->resources;
    }

    public function buildResources()
    {
        \$this->resources = \$this->query->paginate(\$this->request->get('length'));
        \$newCollection = \$this->resources->getCollection();
        \$newCollection->append(\$this->appends->toArray());
        \$this->resources->setCollection(\$newCollection);
    }

    public function loadAnyRelation()
    {
        \$this->columns->pluck('data')->each(function (\$column) {
            if (\Str::contains(\$column, '.')) {
                \$relations = explode('.', \$column);
                array_pop(\$relations);
                \$this->query = \$this->query->with(implode('.', \$relations));
            }
        });
    }

    public function applyQueryScope()
    {
        // dd(\$this->request->all());

        if (\$this->request->has('scope')) {
            \$scopes = explode(',', \$this->request->get('scope'));
            collect(\$scopes)->each(fn (\$scope) => \$this->query = \$this->query->\$scope());
        }

        if (\$this->request->has('append')) {
            \$appends = explode(',', \$this->request->get('append'));
            collect(\$appends)->each(fn (\$append) => \$this->appends->push(\$append));
        }

        if (\$this->request->has('with')) {
            \$with = \$this->request->get('with');
            \$relations = explode(';', \$with);
            \$this->query = \$this->query->with(\$relations);
        }
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
                \$sortable = !empty(\$columns[\$index]['data']) && !\Str::contains(\$columns[\$index]['data'], '.');
                if (\$sortable) {
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