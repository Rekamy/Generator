<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use Rekamy\Generator\Core\StubGenerator;

class RequestExtensionContractsGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Request Extension Criteria Contracts...");
    }

    public function generate()
    {
        try {
            $view = view('backend::criteria.RequestExtensionCriteria')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['criteria']['path'] . 'RequestExtensionCriteria.php'
            );

            $stub->render();
            $this->context->info("Request Extension Criteria Contracts Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
