<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class APIRoutesGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating APIRoutes...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            $data = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = [
                    "className" => Str::of($table)->singular()->studly() . "Controller",
                    "routeName" => Str::of($table)->singular()->slug()
                ];
            }

            $view = view('api::CreateAPIRouteTemplate', $data);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                base_path('routes/crud') . '.php'
            );

            $stub->render();
            $this->context->info("Api Route Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
