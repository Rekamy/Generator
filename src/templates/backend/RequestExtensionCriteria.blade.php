<?= "<?php

namespace App\Contracts\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Exception;

class RequestExtensionCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;
    protected $query;
    protected $columns;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function bindModel($model, RepositoryInterface $repository)
    {
        $this->query = $model;
        $this->repository = $repository;
    }

    /**
     * Apply criteria in query repository
     *
     * @param         Builder|Model     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     * @throws \Exception
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $this->bindModel($model, $repository);

        $this->applyScopes();

        $this->applyAppend();
        // dd($this->query);
        $this->presenter = 'asd';
        return $this->query;
    }

    /**
     * Check and apply scopes if requested.
     *
     * @return void
     */
    public function applyScopes()
    {
        if (!$this->request->has('scopes')) return;

        $scopes = $this->request->get('scopes');
        $scopes = explode(';', $scopes);
        foreach ($scopes as $scope) {
            $this->query = $this->$scope();
        }
    }

    /**
     * Check and apply append if requested.
     *
     * @return void
     */
    public function applyAppend()
    {
        if (!$this->request->has('append')) return;

        $append = $this->request->get('append');
        $appends = explode(';', $append);

        if ($this->query instanceof Model) {
            $this->query->append($appends);
        }

        if ($this->query instanceof Builder) {
            $model = $this->query->getModel();
            $model->append($appends);
            $this->query->setModel($model);
        }
    }
}
"
?>