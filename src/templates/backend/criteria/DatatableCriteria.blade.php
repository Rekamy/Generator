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
    protected \$repository;

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
        if (!\$this->request->has('draw')) return \$model;
        \$this->query = \$model;
        \$this->repository = \$repository;

        if (!\$this->request->has('columns')) throw new Exception('Column does not set', 400);

        \$this->columns = collect(\$this->request->get('columns'))
            ->map(function (\$value, \$index) {
                \$value['index'] = \$index;
                \$column = \Str::of(\$value['data']);
                if (\$column->contains('-')) {
                    \$columnName = \$column->afterLast('-');
                    \$relationName = \$column->beforeLast('-');
                    \$tableName = \$column->beforeLast('-')->afterLast('.')->singular()->plural()->snake();
                    \$value['relation'] = (string) \$relationName;
                    \$value['fullQualifiedColumnAlias'] = (string) "{\$tableName}.{\$columnName} as {\$relationName}-{\$columnName}";
                } else {
                    \$columnName = \$column;
                    \$tableName = \$this->query->getModel()->table;
                    \$value['fullQualifiedColumnAlias'] = (string) "{\$tableName}.{\$columnName}";
                }
                \$value['column'] = (string) "{\$tableName}.{\$columnName}";
                \$value['table'] = (string) \$tableName;
                return \$value;
            });

        \$this->query = \$this->query->select(\$this->columns->pluck('fullQualifiedColumnAlias')->toArray());
        \$this->loadAnyRelation();
        \$this->applyQueryScope();
        \$this->applyFilter();

        if (\$this->isPaginatable()) \$this->resolvePagination();

        \$this->resources = \$this->query->paginate(\$this->request->get('length'));

        return \$this->resources;
    }

    public function loadAnyRelation()
    {
        \$relations = \$this->columns->filter(fn (\$value) => !empty(\$value['relation']));
        \$relations->pluck('relation')->unique()->each(function (\$relation) {
            // TODO: security feat: backend should filter queryable relation
            \$this->query = \$this->query->leftJoinRelationship(\$relation);
        });
    }

    public function applyQueryScope()
    {
        if (\$this->request->has('scope')) {
            \$scopes = explode(',', \$this->request->get('scope'));
            collect(\$scopes)->each(fn (\$scope) => \$this->query = \$this->query->\$scope());
        }

    }

    public function applyFilter()
    {
        if (\$this->request->has('search') && !empty(\$keyword = \$this->request->get('search'))) {
            \$dtSearchable = \$this->columns->where('searchable', 'true');
            // TODO: security feat: backend should filter searchable column
            // \$searchable = array_intersect(\$this->repository->getFieldsSearchable(), \$dtSearchable);
            \$this->query = \$this->query->search(\$dtSearchable->pluck('column')->toArray(), \$keyword['value']);
        }

        if (\$this->request->has('order')) {
            \$orders = \$this->request->get('order');
            foreach (\$orders as \$sort) {
                \$sortable = \$this->columns->where('index', \$sort['column']);
                \$sortable->each(function (\$column) use (\$sort) {
                    \$this->query = \$this->query->orderBy(\$column['column'], \$sort['dir']);
                });
            }
        }
    }
    
    /**
     * Check if Request allow pagination.
     *
     * @return bool
     */
    public function isPaginatable()
    {
        return !is_null(\$this->request->input('start')) &&
            !is_null(\$this->request->input('length')) &&
            \$this->request->input('length') != -1;
    }
}

"
?>
