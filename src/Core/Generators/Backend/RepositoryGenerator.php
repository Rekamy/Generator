<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class RepositoryGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Repository...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating repository for table $table ...");

                $data['context'] = $this->context;
                $data['table'] = $table;
                $data['columns'] = collect($this->context->db->listTableColumns($table))->except('id');
                $data['modelName'] = Str::of($table)->singular()->studly();
                $data['className'] = $data['modelName'] . "Repository";
                $data['namespace'] = $this->context->namespace['repository'];

                $view = view('backend::Repository', $data);

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $this->context->path['backend']['repository'] . $data['className'] . '.php'
                );

                $stub->render();
                $this->context->info("Repository Created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
