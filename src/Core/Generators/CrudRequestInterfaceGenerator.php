<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class CrudRequestInterfaceGenerator
{
    private $context;
 
    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Crud Request Interface...");
    }

    public function generate()
    {
        try {
            $view = view('backend::CrudRequestInterface')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['request_interface'] . 'CrudRequestInterface.php'
            );

            $stub->render();
            $this->context->info("Crud Request Interface Created.");

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
