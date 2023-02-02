<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
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
        $this->tables = $this->context->getTables();
    }

    public function generate()
    {
        $types = [
            'Filter',
            'Get',
            'First',
            'Create',
            'Update',
            'Delete',
            'Model',
        ];
        foreach ($types as $type) {
            $this->generateDoc($type);
        }
    }
    public function generateDoc($type)
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating APIDoc for table $table ...");
                $data['context'] = $this->context;
                $name = Str::of($table);
                $data['table'] = $name;
                $data['columns'] = $this->context->getColumns($table);
                $data['tags'] = $name->studly();
                $data['title'] = $title = $name->headline();
                $data['className'] = $type . $name->singular()->studly() . "APIDoc";

                $data['route'] = '/api/' . Str::slug(Str::singular($table));

                $view = view("swagger::{$type}APIDoc", $data);
                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $this->context->config->setup->backend->api_doc->path . $data['className'] . '.php'
                );

                $stub->render();
                $this->context->info("{$type} {$title} APIDoc Created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
