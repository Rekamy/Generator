<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use Rekamy\Generator\Core\StubGenerator;

class RequestCriteriaContractsGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Request Criteria Contracts...");
    }

    public function generate()
    {
        try {
            $view = view('backend::criteria.RequestCriteria')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['override']['path'] . 'RequestCriteria.php'
            );

            $stub->render();
            $this->context->info("Request Criteria Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
