<?php

namespace Rekamy\Generator\Core\Generators;

use Rekamy\Generator\Console\StubGenerator;

class AppServiceProvidersGenerator
{
    private $context;
 
    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating App Service Provides...");
    }

    public function generate()
    {
        try {
            $view = view('backend::AppServiceProviders')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                app_path('Providers/') . 'AppServiceProvider.php'
            );

            $stub->render();
            $this->context->info("DataTable Criteria Contracts Created.");

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
