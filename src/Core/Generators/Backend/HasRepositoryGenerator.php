<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class HasRepositoryGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating HasRepository Trait...");
    }

    public function generate()
    {
        try {
            $view = view('backend::HasRepository')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['has_repository_trait']['path'] . 'HasRepository.php'
            );

            $stub->render();
            $this->context->info("HasRepository Trait Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
