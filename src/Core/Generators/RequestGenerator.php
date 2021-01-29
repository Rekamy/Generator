<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class RequestGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Request...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating Request for table $table ...");

                $data['context'] = $this->context;
                $data['table'] = $table;
                $data['columns'] = collect($this->context->db->listTableColumns($table))->except('id');
                $data['className'] = Str::of($table)->singular()->studly() . "Request";
                $data['blocName'] = Str::of($table)->singular()->studly() . "Bloc";

                $view = view('backend::Request', $data);

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    app_path('Http/Requests/') . $data['className'] . '.php'
                );

                $stub->render();
                $this->context->info("Request Created.");
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
