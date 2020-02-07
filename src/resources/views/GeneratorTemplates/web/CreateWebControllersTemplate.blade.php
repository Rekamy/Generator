<?=
"<?php

namespace " . $context->namespace['web_controller'] . ";

use App\Http\Requests;
use App\DataTables\\" . ucfirst(Str::camel(Str::singular($tablename))) . "DataTable;
use " . $context->namespace['web_request'] . "\Create" . ucfirst(Str::camel(Str::singular($tablename))) . "Request;
use " . $context->namespace['web_request'] . "\Update" . ucfirst(Str::camel(Str::singular($tablename))) . "Request;
use " . $context->namespace['repository'] . "\\" . ucfirst(Str::camel(Str::singular($tablename))) . "Repository;
use " . $context->namespace['web_controller'] . "\AppBaseController;
use Response;

class " . ucfirst(Str::camel(Str::singular($tablename))) . "Controller extends AppBaseController
{
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
    public function index(" . ucfirst(Str::camel(Str::singular($tablename))) . "DataTable \$" . lcfirst(Str::camel(Str::singular($tablename))) . "DataTable)
    {
        return \$" . lcfirst(Str::camel(Str::singular($tablename))) . "DataTable->render('" . lcfirst(Str::camel(Str::singular($tablename))) . ".index');
    }

    /**
     * Show the form for creating a new " . ucfirst(Str::camel(Str::singular($tablename))) . ".
     *
     * @return Response
     */
    public function create()
    {
        return view('" . lcfirst(Str::camel(Str::singular($tablename))) . ".create');
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

        \$" . lcfirst(Str::camel(Str::singular($tablename))) . " = \$this->" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository->create(\$input);

        return redirect(route('" . lcfirst(Str::camel(Str::singular($tablename))) . ".index'));
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

        return view('" . lcfirst(Str::camel(Str::singular($tablename))) . ".show')->with('" . lcfirst(Str::camel(Str::singular($tablename))) . "', \$" . lcfirst(Str::camel(Str::singular($tablename))) . ");
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

        return view('" . lcfirst(Str::camel(Str::singular($tablename))) . ".edit')->with('" . lcfirst(Str::camel(Str::singular($tablename))) . "', \$" . lcfirst(Str::camel(Str::singular($tablename))) . ");
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
        \$" . lcfirst(Str::camel(Str::singular($tablename))) . " = \$this->" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository->findWithoutFail(\$id);

        \$" . lcfirst(Str::camel(Str::singular($tablename))) . " = \$this->" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository->update(\$request->all(), \$id);

        return redirect(route('" . lcfirst(Str::camel(Str::singular($tablename))) . ".index'));
    }

    /**
     * Remove the specified " . ucfirst(Str::camel(Str::singular($tablename))) . " from storage.
     *
     * @param  int \$id
     *
     * @return Response
     */
    public function destroy(\$id)
    {
        \$" . lcfirst(Str::camel(Str::singular($tablename))) . " = \$this->" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository->findWithoutFail(\$id);

        \$this->" . lcfirst(Str::camel(Str::singular($tablename))) . "Repository->delete(\$id);

        return redirect(route('" . lcfirst(Str::camel(Str::singular($tablename))) . ".index'));
    }
}
"?>