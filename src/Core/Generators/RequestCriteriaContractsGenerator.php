<?php

namespace Rekamy\Generator\Core\Generators;

use Rekamy\Generator\Console\StubGenerator;

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
            $view = view('backend::RequestCriteria')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['override'] . 'RequestCriteria.php'
            );

            $stub->render();
            $this->context->info("Request Criteria Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
