<?=
"<?php

namespace " . $context->namespace['api_controller'] . ";

use App\Http\Requests\API\Create" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest;
use App\Http\Requests\API\Update" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest;
use App\Models\\" . ucfirst(Str::camel(Str::singular($tablename))) . ";
use " . $context->namespace['repository'] . "\\" . ucfirst(Str::camel(Str::singular($tablename))) . "Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class " . ucfirst(Str::camel(Str::singular($tablename))) . "Controller
 * @package " . $context->namespace['api_controller'] . "
 */
class " . ucfirst(Str::camel(Str::singular($tablename))) . "APIController extends AppBaseController
{
    /** @var  " . ucfirst(Str::camel(Str::singular($tablename))) . "Repository */
    private \$" . Str::camel(Str::singular($tablename)) . "Repository;

    public function __construct(" . ucfirst(Str::camel(Str::singular($tablename))) . "Repository \$" . Str::camel(Str::singular($tablename)) . "Repo)
    {
        \$this->" . Str::camel(Str::singular($tablename)) . "Repository = \$" . Str::camel(Str::singular($tablename)) . "Repo;
    }

    /**
     * @param Request \$request
     * @return Response
     */
    public function index(Request \$request)
    {
        \$this->" . Str::camel(Str::singular($tablename)) . "Repository->pushCriteria(new RequestCriteria(\$request));
        \$this->" . Str::camel(Str::singular($tablename)) . "Repository->pushCriteria(new LimitOffsetCriteria(\$request));
        \$" . Str::camel($tablename) . " = \$this->" . Str::camel(Str::singular($tablename)) . "Repository->paginate(10);

        return \$this->sendResponse(\$" . Str::camel($tablename) . "->toArray(), '" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " retrieved successfully');
    }

    /**
     * @param Create" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest \$request
     * @return Response
     */
    public function store(Create" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest \$request)
    {
        \$input = \$request->all();

        \$" . Str::camel($tablename) . " = \$this->" . Str::camel(Str::singular($tablename)) . "Repository->create(\$input);

        return \$this->sendResponse(\$" . Str::camel($tablename) . "->toArray(), '" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " saved successfully');
    }

    /**
     * @param int \$id
     * @return Response
     */
    public function show(\$id)
    {
        /** @var " . ucFirst(Str::camel(Str::singular($tablename))) . " \$" . Str::camel($tablename) . " */
        \$" . Str::camel($tablename) . " = \$this->" . Str::camel(Str::singular($tablename)) . "Repository->findWithoutFail(\$id);

        if (empty(\$" . Str::camel($tablename) . ")) {
            return \$this->sendError('" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " not found');
        }

        return \$this->sendResponse(\$" . Str::camel($tablename) . "->toArray(), '" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " retrieved successfully');
    }

    /**
     * @param int \$id
     * @param Update" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest \$request
     * @return Response
     */
    public function update(\$id, Update" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest \$request)
    {
        \$input = \$request->all();

        /** @var " . ucfirst(Str::camel($tablename)) . " \$" . Str::camel($tablename) . " */
        \$" . Str::camel($tablename) . " = \$this->" . Str::camel(Str::singular($tablename)) . "Repository->findWithoutFail(\$id);

        if (empty(\$" . Str::camel($tablename) . ")) {
            return \$this->sendError('" . ucFirst(str_replace('_', ' ', $tablename)) . " not found');
        }

        \$" . Str::camel($tablename) . " = \$this->" . Str::camel(Str::singular($tablename)) . "Repository->update(\$input, \$id);

        return \$this->sendResponse(\$" . Str::camel($tablename) . "->toArray(), '" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " updated successfully');
    }

    /**
     * @param int \$id
     * @return Response
     */
    public function destroy(\$id)
    {
        /** @var " . ucfirst(Str::camel($tablename)) . " \$" . Str::camel($tablename) . "  */
        \$" . Str::camel($tablename) . " = \$this->" . Str::camel(Str::singular($tablename)) . "Repository->findWithoutFail(\$id);

        if (empty(\$" . Str::camel($tablename) . ")) {
            return \$this->sendError('" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " not found');
        }

        \$" . Str::camel($tablename) . "->delete();

        return \$this->sendResponse(\$id, '" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " deleted successfully');
    }

    /**
     * @param int \$id
     * @return Response
     */
    public function filterData(Request \$request)
    {
        \$this->" . Str::camel(lcfirst(Str::singular($tablename))) . "Repository->pushCriteria(new RequestCriteria(\$request));
        \$this->" . Str::camel(lcfirst(Str::singular($tablename))) . "Repository->pushCriteria(new LimitOffsetCriteria(\$request));
        \$input = \$request->all();
        
        if(!empty(\$input))
        {
            \$" . Str::camel(lcfirst($tablename)) . " = \$this->" . Str::camel(lcfirst(Str::singular($tablename))) . "Repository->findWhere(\$input);
            return \$this->sendResponse(\$" . Str::camel(lcfirst($tablename)) . "->toArray(), '" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " retrieved successfully');
        } else {
            \$" . Str::camel(lcfirst($tablename)) . " = \$this->" . Str::camel(lcfirst(Str::singular($tablename))) . "Repository->all();
            return \$this->sendResponse(\$" . Str::camel(lcfirst($tablename)) . "->toArray(), '" . ucfirst(str_replace('_', '', $tablename)) . " retrieved successfully');
        }
    }
}
"
?>
