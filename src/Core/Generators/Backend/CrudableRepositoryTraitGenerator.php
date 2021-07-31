<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class CrudableRepositoryTraitGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Crudable Repository Trait...");
    }

    public function generate()
    {
        try {
            $view = view('backend::CrudableRepositoryTrait')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['crudable_repository_trait']['path'] . 'CrudableRepository.php'
            );

            $stub->render();
            $this->context->info("Crudable Repository Trait Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
