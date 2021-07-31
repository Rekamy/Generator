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
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });

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

                $data['columns'] = collect($this->context->db->listTableColumns($table))->except('id');
                $data['uuid'] = collect($this->context->db->listTableColumns($table))->get('id') ?
                    collect($this->context->db->listTableColumns($table))->get('id')->getType()->getName() : false;
                $data['isUuid'] = ($data['uuid'] == "string");
                $data['softDelete'] = $data['columns']->get('deleted_at') && $this->context->options->get('softDelete');
                $data['className'] = Str::of($table)->singular()->studly();
                $data['namespace'] = $this->context->path['backend']['model']['namespace'];
                $data['notNullColumns'] = $data['columns']->filter(function ($column) {
                    return $column->getNotnull();
                });
                if ($this->context->options->get('relation')) {
                    $data['relations'] = [];
                    foreach ($this->context->relations->where('table', $table) as $relation) {
                        array_push($data['relations'], $this->context->makeRelation($relation));
                    }
                }

                $view = view('backend::Model', $data);
                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $this->context->path['backend']['model']['path'] . $data['className'] . '.php'
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
