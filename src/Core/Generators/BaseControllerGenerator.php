<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
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
            $view = view('generaltemplate::BaseController')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['base_controller'] . 'Controller.php'
            );

            $stub->render();
            $this->context->info("BaseController Created.");

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
