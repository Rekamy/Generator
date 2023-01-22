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
        $this->tables = $this->context->getTables();
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating repository for table $table ...");

                $data['context'] = $this->context;
                $data['table'] = $table;
                $data['columns'] = $this->context->getColumns($table);
                $data['modelName'] = Str::of($table)->singular()->studly();
                $data['className'] = $data['modelName'] . "Repository";
                $data['namespace'] = $this->context->config->setup->backend->repository->namespace;

                $view = view('backend::Repository', $data);

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $this->context->config->setup->backend->repository->path . $data['className'] . '.php'
                );

                $stub->render();
                $this->context->info("Repository Created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
