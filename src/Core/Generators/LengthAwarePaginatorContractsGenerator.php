<?php

namespace Rekamy\Generator\Core\Generators;

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
            $view = view('backend::LengthAwarePaginator')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                app_path('Contracts/Overrides/') . 'LengthAwarePaginator.php'
            );

            $stub->render();
            $this->context->info("Length Aware Paginator Overrides Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
