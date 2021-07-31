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
                $data['table'] = Str::of($table);
                $data['columns'] = collect($this->context->db->listTableColumns($table))->except('id');
                $data['tags'] = Str::of($table)->studly();
                $data['title'] = Str::of($table)->absoluteTitle();
                $data['className'] = Str::of($table)->singular()->studly() . "APIDoc";

                $data['route'] = '/api/' . Str::slug(Str::singular($table));

                $view = view('swagger::APIDoc', $data);

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $this->context->path['backend']['api_doc'] . $data['className'] . '.php'
                );

                $stub->render();
                $this->context->info("APIDoc Created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
