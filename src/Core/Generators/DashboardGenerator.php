<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class DashboardGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Dashboard file...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        // try {
        //     $view = view('frontend::route');

        //     $stub = new StubGenerator(
        //         $this->context,
        //         $view->render(),
        //         resource_path("frontend/src/router/crud.ts")
        //     );

        //     $stub->render();
        //     $this->context->info("Template file Created.");
        // } catch (\Throwable $th) {
        //     throw $th;
        // }
    }
}
