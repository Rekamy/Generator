<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use Rekamy\Generator\Console\StubGenerator;

class LengthAwarePaginatorContractsGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Length Aware Paginator Overrides Contracts...");
    }

    public function generate()
    {
        try {
            $view = view('backend::override.LengthAwarePaginator')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['override'] . 'LengthAwarePaginator.php'
            );

            $stub->render();
            $this->context->info("Length Aware Paginator Overrides Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
