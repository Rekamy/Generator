<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class BaseVueGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Vue...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating Vue for Table $table ...");

                // $data['context'] = $this->context;
                // $data['table'] = $table;
                $data['columns'] = collect($this->context->db->listTableColumns($table))
                    ->except([
                        'id', 'created_at', 'updated_at', 'created_by', 'updated_by',
                        'deleted_at', 'deleted_by', 'remark',
                    ]);
                $data['table'] =  $table;
                $data['title'] =  Str::title($table);
                // $data['repoName'] = Str::studly(Str::singular($table)) . "Repository";
                // $data['requestName'] = Str::studly(Str::singular($table)) . "Request";

                $view = view('frontend::BaseVue', $data);

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    resource_path("frontend/src/views/crud/$table/") . $table . '.vue'
                );

                $stub->render();
                $this->context->info("Vue Table $table Created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
