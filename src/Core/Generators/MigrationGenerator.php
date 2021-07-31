<?php

namespace Rekamy\Generator\Core\Generators;

use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;

class MigrationGenerator
{
    private $context;

    private $tables;

    private $relations;

    private $tempRelations;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Migrations...");
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
                $this->context->info("Creating migration for table $table ...");

                $data['context'] = $this->context;
                $data['table'] = $table;

                $data['columns'] = collect($this->context->db->listTableColumns($table))->except('id');
                $data['softDelete'] = $data['columns']->get('deleted_at') && $this->context->options->get('softDelete');
                $data['className'] = "Create" . Str::studly(Str::plural($table)) . "Table";
                $data['columnRules'] = $this->getColumnRules($table);

                $filename = "2019_08_19_000001_create_" . Str::snake(Str::plural($table)) . "_table";

                $view = view('migration::Migration', $data);

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $this->context->path['migration'] . $filename . '.php'
                );
                $stub->render();

                $this->context->info("Migration $filename Created.");
                $this->context->newline();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getColumnRules($table)
    {
        $rules = [];
        $columns = collect($this->context->db->listTableColumns($table));
        foreach ($columns as $key => $column) {
            $isId = $column->getName() == 'id';
            $type = $column->getType()->getName();

            switch ($type) {
                case 'bigint':
                    $parsedType = 'bigInteger';
                    break;

                default:
                    $parsedType = $type;
                    break;
            }

            $name = $column->getName();
            $rule = $isId ? "\$table->id()" : "\$table->$parsedType('$name')";

            if (!$isId) {
                $rule .= $column->getUnsigned() ? '->unsigned()' : '';
                $rule .= !$column->getNotnull() ? '->nullable()' : '';
                $rule .= $column->getComment() ? "->comment(\"{$column->getComment()}\")" : '';
            }

            $rules[] = $rule . ';';
        }
        return $rules;
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
