<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class CrudableTraitGenerator
{
    private $context;
 
    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating CrudableTrait...");
    }

    public function generate()
    {
        try {
            $view = view('generaltemplate::CrudableTrait')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                app_path('Contracts/Bloc/Concerns/') . 'CrudableBloc.php'
            );

            $stub->render();
            $this->context->info("CrudableTrait Created.");

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
