<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class CrudBlocInterfaceGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating CrudBlocInterface...");
    }

    public function generate()
    {
        try {
            $view = view('backend::CrudBlocInterface')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['crud_bloc_interface'] . 'CrudBlocInterface.php'
            );

            $stub->render();
            $this->context->info("CrudBlocInterface Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
