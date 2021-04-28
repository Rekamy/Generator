<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class HasRequestGenerator
{
    private $context;
 
    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating HasRequest Trait...");
    }

    public function generate()
    {
        try {
            $view = view('backend::HasRequest')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['has_request_trait'] . 'HasRequest.php'
            );

            $stub->render();
            $this->context->info("HasRequest Trait Created.");

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
