<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class BlocGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Bloc...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating Bloc for table $table ...");

                $data['context'] = $this->context;
                $data['table'] = $table;
                $data['columns'] = collect($this->context->db->listTableColumns($table))->except('id');
                $data['className'] = Str::of($table)->singular()->studly() . "Bloc";
                $data['repoName'] = Str::of($table)->singular()->studly() . "Repository";
                $data['requestName'] = Str::of($table)->singular()->studly() . "Request";

                $view = view('backend::Bloc', $data);

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $this->context->path['backend']['bloc'] . $data['className'] . '.php'
                );

                $stub->render();
                $this->context->info("Bloc Created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
