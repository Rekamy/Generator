<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
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
        if ($this->context->options->get('relation')) {
            $this->makeRelations();
        }
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating model for table $table ...");
                $data['context'] = $this->context;
                $data['table'] = $table;

                $data['columns'] = collect($this->context->db->listTableColumns($table))->except('id');
                $data['softDelete'] = $data['columns']->get('deleted_at') && $this->context->options->get('softDelete');
                $data['className'] = ucfirst(Str::camel(Str::singular($table)));
                $data['namespace'] = $this->context->namespace['model'];
                $data['notNullColumns'] = $data['columns']->filter(function ($column) {
                    return $column->getNotnull();
                });
                if ($this->context->options->get('relation')) {
                    $data['relations'] = $this->relations;
                }

                $view = view('generaltemplate::Model', $data);

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $this->context->path['model'] . $data['className'] . '.php'
                );
                $stub->render();
                $this->context->info("Models {$data['className']} Created.");
                $this->context->newline();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function makeRelations()
    {
        $this->relations = collect();
        foreach ($this->tables as $table) {
            $this->tempRelations = [];
            collect($this->context->db->listTableForeignKeys($table))
                ->each(function ($fk) use ($table) {
                    $relation = $this->makeRelation($fk);
                    if (empty($this->tempRelations[$table])) {
                        $this->tempRelations[$table] = [];
                    }
                    array_push($this->tempRelations[$table], $relation);

                    $foreignTable = $fk->getForeignTableName();
                    $inverseRelation = $this->makeInverseRelation($fk, $table);
                    if (empty($this->tempRelations[$foreignTable])) {
                        $this->tempRelations[$foreignTable] = [];
                    }
                    array_push($this->tempRelations[$foreignTable], $inverseRelation);
                });
            $this->relations->push($this->tempRelations);
        }
        $collect = collect();
        $this->relations->filter(function ($item) {
            return !empty($item);
        })
            ->each(function ($item)  use ($collect) {
                collect($item)->each(function ($item, $key) use ($collect) {
                    $collect->put($key, $item);
                });
            });
        $this->relations = $collect;
    }

    public function makeInverseRelation($details, $localTable)
    {
        $fkIsPrimary = in_array('id', $details->getForeignColumns());
        if ($fkIsPrimary) {
            $relationName = Str::plural(Str::camel($localTable));
        } else {
            $localKey = Str::studly($details->getForeignColumns());
            $foreignTable = Str::camel($localTable);
            $relationName = Str::plural($foreignTable . $localKey);
            if (Str::contains($details->getForeignColumns(), $localTable)) {
                str_replace($localTable, '', $details->getLocalColumns());
            }
        }

        $foreignModel = Str::singular(Str::studly($localTable)) . '::class';

        $html = "\tpublic function $relationName()\n";
        $html .= "\t{\n";
        $html .= "\t\treturn \$this->hasMany($foreignModel);\n";
        $html .= "\t}\n";


        // dd($details->getName());
        return  $html;
    }

    public function makeRelation($details)
    {

        $fkIsPrimary = in_array('id', $details->getForeignColumns());
        if ($fkIsPrimary) {
            $relationName = Str::singular(Str::camel($details->getForeignTableName()));
        } else {
            $localKey = Str::studly($details->getLocalColumns());
            $foreignTable = Str::camel($details->getForeignTableName());
            $relationName = $foreignTable . $localKey;
            if (Str::contains($details->getLocalColumns(), $details->getForeignTableName())) {
                str_replace($details->getForeignTableName(), '', $details->getLocalColumns());
            }
        }

        $foreignModel = Str::singular(Str::studly($details->getForeignTableName())) . '::class';

        $html = "\tpublic function $relationName()\n";
        $html .= "\t{\n";
        $html .= "\t\treturn \$this->belongsTo($foreignModel);\n";
        $html .= "\t}\n";


        // dd($details->getName());
        return  $html;
    }
}
