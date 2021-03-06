<?=
"<?php

namespace " . $context->namespace['web_controller'] . ";

use Illuminate\Http\Request;
use App\DataTables\\" . ucfirst(Str::camel(Str::singular($tablename))) . "DataTable;
use " . $context->namespace['web_request'] . "\Create" . ucfirst(Str::camel(Str::singular($tablename))) . "Request;
use " . $context->namespace['web_request'] . "\Update" . ucfirst(Str::camel(Str::singular($tablename))) . "Request;
use " . $context->namespace['repository'] . "\\" . ucfirst(Str::camel(Str::singular($tablename))) . "Repository;
use " . $context->namespace['web_controller'] . "\AppBaseController;
use Response;
use Rekamy\Generator\Console\Traits\ResponseHandler;

class " . ucfirst(Str::camel(Str::singular($tablename))) . "Controller extends AppBaseController
{
    use ResponseHandler;

    private \$page = '" . ucfirst(Str::camel(Str::singular($tablename))) . "';

    /** @var  " . ucfirst(Str::camel(Str::singular($tablename))) . "Repository */
    private \$" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository;

    public function __construct(" . ucfirst(Str::camel(Str::singular($tablename))) . "Repository \$" . lcfirst(Str::camel(Str::singular($tablename))) . "Repo)
    {
        \$this->" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository = \$" . lcfirst(Str::camel(Str::singular($tablename))) . "Repo;
    }

    /**
     * Display a listing of the " . ucfirst(Str::camel(Str::singular($tablename))) . ".
     *
     * @param " . ucfirst(Str::camel(Str::singular($tablename))) . "DataTable \$" . lcfirst(Str::camel(Str::singular($tablename))) . "DataTable
     * @return Response
     */
    public function index(Request \$request)
    {
        if (\$request->ajax()) {
            \$input = \$request->all();

            \$output = \$this->" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository->" . lcfirst(Str::camel($tablename)) . "(\$input)->toArray();

            \$response = [
                \"draw\"            => \$input['draw'],
                \"recordsTotal\"    => intval(\$output['total']),
                \"recordsFiltered\" => intval(\$output['total']),
                \"data\"            => \$output['data']
            ];
            return response()->json(\$response, 200);
        }
        return view('" . lcfirst(Str::singular(str_replace('_', '-', $tablename))) . ".index')->with('page', \$this->page);
    }

    /**
     * Show the form for creating a new " . ucfirst(Str::camel(Str::singular($tablename))) . ".
     *
     * @return Response
     */
    public function create()
    {
        return view('" . lcfirst(Str::singular(str_replace('_', '-', $tablename))) . ".create')->with('page', \$this->page);
    }

    /**
     * Store a newly created " . ucfirst(Str::camel(Str::singular($tablename))) . " in storage.
     *
     * @param Create" . ucfirst(Str::camel(Str::singular($tablename))) . "Request \$request
     *
     * @return Response
     */
    public function store(Create" . ucfirst(Str::camel(Str::singular($tablename))) . "Request \$request)
    {
        \$input = \$request->all();

        \$" . lcfirst(Str::camel(Str::singular($tablename))) . " = \$this->" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository->create" . ucfirst(Str::camel(Str::singular($tablename))) . "(\$input);

        return \$this->successResponse('Successfully Insert New Data', \$" . lcfirst(Str::camel(Str::singular($tablename))) . ");
    }

    /**
     * Display the specified " . ucfirst(Str::camel(Str::singular($tablename))) . ".
     *
     * @param  int \$id
     *
     * @return Response
     */
    public function show(\$id)
    {
        \$" . lcfirst(Str::camel(Str::singular($tablename))) . " = \$this->" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository->findWithoutFail(\$id);

        return view('" . lcfirst(Str::singular(str_replace('_', '-', $tablename))) . ".show')->with('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "', \$" . lcfirst(Str::camel(Str::singular($tablename))) . ")->with('page', \$this->page);
    }

    /**
     * Show the form for editing the specified " . ucfirst(Str::camel(Str::singular($tablename))) . ".
     *
     * @param  int \$id
     *
     * @return Response
     */
    public function edit(\$id)
    {
        \$" . lcfirst(Str::camel(Str::singular($tablename))) . " = \$this->" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository->findWithoutFail(\$id);

        return view('" . lcfirst(Str::singular(str_replace('_', '-', $tablename))) . ".edit')->with('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "', \$" . lcfirst(Str::camel(Str::singular($tablename))) . ")->with('page', \$this->page);
    }

    /**
     * Update the specified " . ucfirst(Str::camel(Str::singular($tablename))) . " in storage.
     *
     * @param  int \$id
     * @param Update" . ucfirst(Str::camel(Str::singular($tablename))) . "Request \$request
     *
     * @return Response
     */
    public function update(\$id, Update" . ucfirst(Str::camel(Str::singular($tablename))) . "Request \$request)
    {
        \$input = \$request->all();

        \$" . lcfirst(Str::camel(Str::singular($tablename))) . " = \$this->" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository->update" . ucfirst(Str::camel(Str::singular($tablename))) . "(\$id, \$input);

        return \$this->successResponse('Successfully Update Data', \$" . lcfirst(Str::camel(Str::singular($tablename))) . ");
    }

    /**
     * Remove the specified " . ucfirst(Str::camel(Str::singular($tablename))) . " from storage.
     *
     * @param int \$id
     *
     * @return Response
     */
    public function destroy(\$id)
    {
        return \$this->" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository->delete" . ucfirst(Str::camel(Str::singular($tablename))) . "(\$id);
    }
}
"?>