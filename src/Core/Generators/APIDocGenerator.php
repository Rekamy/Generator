<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class APIDocGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating APIDoc...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating APIDoc for table $table ...");

                $data['context'] = $this->context;
                $data['table'] = $table;
                $data['columns'] = collect($this->context->db->listTableColumns($table))->except('id');
                $data['tags'] = Str::studly($table);
                $data['title'] = Str::title($table);
                $data['className'] = Str::studly(Str::singular($table)) . "APIDoc";
                
                $data['route'] = '/api/' . Str::kebab(Str::singular($table));

                $view = view('swagger::APIDoc', $data);

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    app_path('APIDoc/') . $data['className'] . '.php'
                );

                $stub->render();
                $this->context->info("APIDoc Created.");
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
