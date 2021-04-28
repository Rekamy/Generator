<?php

namespace Rekamy\Generator\Core\Generators;

use Rekamy\Generator\Console\StubGenerator;

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
            $view = view('backend::RequestExtensionCriteria')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['criteria'] . 'RequestExtensionCriteria.php'
            );

            $stub->render();
            $this->context->info("Request Extension Criteria Contracts Created.");

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
