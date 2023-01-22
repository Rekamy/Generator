<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class BaseControllerGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating BaseController...");
    }

    public function generate()
    {
        try {
            $view = view('backend::controller.BaseController')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->config->setup->backend->base_controller->path . 'Controller.php'
            );

            $stub->render();
            $this->context->info("BaseController Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
