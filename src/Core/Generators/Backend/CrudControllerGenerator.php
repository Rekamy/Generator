<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class CrudControllerGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Crud Controller...");
    }

    public function generate()
    {
        try {
            $view = view('backend::controller.CrudController')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['base_controller']['path'] . 'CrudController.php'
            );

            $stub->render();
            $this->context->info("Crud Controller Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
