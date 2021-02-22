<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class ControllerGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Controller...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating Controller for table $table ...");
                $name = Str::of($table);
                $data['context'] = $this->context;
                $data['table'] = $name;
                $data['slug'] = $name->slug();
                $data['snake'] = $name->snake();
                $data['className'] = $name->singular()->studly() . "Controller";
                $data['blocName'] = $name->singular()->studly() . "Bloc";

                $view = view('backend::Controller', $data);

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    app_path('Http/Controllers/') . $data['className'] . '.php'
                );

                $stub->render();
                $this->context->info("Controller Created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
