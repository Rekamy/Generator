<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class CrudRepositoryInterfaceGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Crud Repository Interface...");
    }

    public function generate()
    {
        try {
            $view = view('backend::CrudRepositoryInterface')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['crud_repository_interface'] . 'CrudRepositoryInterface.php'
            );

            $stub->render();
            $this->context->info("Crud Repository Interface Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
