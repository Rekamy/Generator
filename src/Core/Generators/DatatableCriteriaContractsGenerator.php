<?php

namespace Rekamy\Generator\Core\Generators;

use Rekamy\Generator\Console\StubGenerator;

class DatatableCriteriaContractsGenerator
{
    private $context;
 
    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating DataTable Criteria Contracts...");
    }

    public function generate()
    {
        try {
            $view = view('backend::DatatableCriteria')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['criteria'] . 'DataTableCriteria.php'
            );

            $stub->render();
            $this->context->info("DataTable Criteria Contracts Created.");

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
