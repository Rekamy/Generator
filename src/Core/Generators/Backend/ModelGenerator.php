<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;
use Illuminate\Console\OutputStyle;
use Symfony\Component\Console\Output\ConsoleOutput;

class ModelGenerator
{
    private $context;

    private $tables;

    private $relations;

    private $tempRelations;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Models...");
        $this->tables = $this->context->getTables();

        $this->relations = collect();

        $this->context->info("Make relationships collection...");
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating model for table $table ...");
                $data['context'] = $this->context;
                $data['table'] = $table;

                $data['columns'] = $this->context->getColumns($table);
                $primary = collect($this->context->db->listTableColumns($table))->get('id');
                $data['uuid'] =  $primary ? $primary->getType()->getName() : false;
                $data['isUuid'] = ($data['uuid'] == "string");
                $data['softDelete'] = $data['columns']->get('deleted_at') && $this->context->config->options->get('softDelete');
                $data['className'] = Str::of($table)->singular()->studly();
                $data['namespace'] = $this->context->config->setup->backend->model->namespace;
                $data['notNullColumns'] = $data['columns']->filter(function ($column) {
                    return $column->getNotnull();
                });
                if ($this->context->config->options->relation) {
                    $data['relations'] = [];
                    foreach ($this->context->relations->where('table', $table) as $relation) {
                        array_push($data['relations'], $this->context->makeRelation($relation));
                    }
                }

                $view = view('backend::Model', $data);
                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $this->context->config->setup->backend->model->path . $data['className'] . '.php'
                );
                $stub->render();
                $this->context->info("Models {$data['className']} Created.");
                $this->context->newline();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
