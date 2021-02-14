<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class VueConfigGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        // $this->context = $context;
        // $this->context->info("Creating Template file...");
        // $this->tables = collect($this->context->db->listTableNames())
        //     ->filter(function ($item) {
        //         return !in_array($item, $this->context->excludeTables);
        //     });
    }

    public function generate()
    {
        // try {
        //     $data['routes'] = [];
        //     foreach ($this->tables as $key => $table) {
        //         $data['routes'][] = Str::of($table)->singular();
        //     }

        //     $view = view('frontend::route', $data);

        //     $stub = new StubGenerator(
        //         $this->context,
        //         $view->render(),
        //         resource_path("frontend/src/router/crud.ts")
        //     );

        //     $stub->render();
        //     $this->context->info("Route file Created.");
        // } catch (\Throwable $th) {
        //     throw $th;
        // }
    }
}
