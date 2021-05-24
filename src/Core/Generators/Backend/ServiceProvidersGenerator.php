<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use Rekamy\Generator\Console\StubGenerator;

class ServiceProvidersGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Service Provides...");
    }

    public function generate()
    {
        try {
            $this->generateAppServiceProvider();
            $this->generateRouteServiceProvider();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function generateAppServiceProvider()
    {
        $view = view('backend::service-provider.AppServiceProviders')
            ->with('context', $this->context);

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            $this->context->path['backend']['providers'] . 'AppServiceProvider.php'
        );

        $stub->render();
        $this->context->info("App Service Provider created.");
    }

    private function generateRouteServiceProvider()
    {
        $view = view('backend::service-provider.RouteServiceProviders')
            ->with('context', $this->context);

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            $this->context->path['backend']['providers'] . 'RouteServiceProvider.php'
        );

        $stub->render();
        $this->context->info("Route Service Provider created.");
    }
}
