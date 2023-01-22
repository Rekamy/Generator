<?php

namespace Rekamy\Generator\Core;

use DB;
use Str;

trait BuildConfig
{

    public $config;
    public $dbname;
    public $excludeTables = [];
    public $generate;
    public $path;
    public $options;
    // public $namespace;
    public $appName;
    public $template;
    public $db = [];
    // public $output = [];
    public $outputDecorator;
    public $progress;
    public $relations;

    public function loadConfig()
    {
        $this->config = json_decode(json_encode(config('rekamygenerator')));
        $this->relations = collect();

        // FIXME: on migrate, schema manager does not get latest db struct
        $db = \DB::connection();
        $schema = $db->getDoctrineSchemaManager();

        $this->db = $schema;

        $this->tables = collect($this->db->listTableNames())
            ->filter(fn ($item) =>  !in_array($item, $this->config->database->exclude_tables));

        $this->cacheRelationship();
    }

    private function cacheRelationship()
    {
        foreach ($this->tables as $table) {
            collect($this->db->listTableForeignKeys($table))
                ->each(function ($fk) use ($table) {

                    $record = [
                        'table' => $table,
                        'targetTable' => $fk->getForeignTableName(),
                        'relName' => (string) $this->parseName($fk->getLocalColumns()[0])->singular(),
                        'relType' => 'belongsTo',
                        'foreignModel' => (string) $this->parseName($fk->getLocalColumns()[0])->singular()->ucfirst(),
                        'referenceColumn' => $fk->getLocalColumns()[0],
                        'targetKey' => $fk->getForeignColumns()[0],
                    ];
                    $this->relations->push($record);
                    $inverseRecord = [
                        'table' => $fk->getForeignTableName(),
                        'targetTable' => $table,
                        'relName' => $fk->getForeignColumns()[0] == 'id' ? (string) $this->parseName($table) : (string) $this->parseName($fk->getForeignColumns()[0]),
                        'relType' => 'hasMany',
                        'foreignModel' => (string) $this->parseName($table)->singular()->ucfirst(),
                        'referenceColumn' => $fk->getLocalColumns()[0],
                        'targetKey' => $fk->getForeignColumns()[0],
                        'registerBy' => $table,
                    ];
                    $this->relations->push($inverseRecord);
                });
        }
    }

    public function getColumns($table, $skip = [])
    {
        return collect($this->db->listTableColumns($table))
            ->filter(fn ($item) => !in_array($item->getName(), $this->config->database->skipColumns))
            ->filter(fn ($item) => !in_array($item->getName(), $skip));
    }

    public function getTables($db = null)
    {
        return collect($this->db->listTableNames())
            ->merge($this->config->database->include_tables)
            ->filter(fn ($item) => !in_array($item, $this->config->database->exclude_tables));
    }

    private function parseName($name)
    {
        $parsedName = $name = \Str::of($name);
        if ($name->endsWith('_id'))
            $parsedName = $name->remove('_id');

        return $parsedName->camel();
    }

    public function makeRelation($detail)
    {
        $relType = $detail['relType'];
        $relName = $detail['relName'];
        $foreignModel = $detail['foreignModel'];

        if (!class_exists($foreignModel)) return;

        $referenceColumn = $detail['referenceColumn'];
        $targetKey = $detail['targetKey'];
        $relModel = ucfirst($relType);

        $html = <<<PHP
        public function $relName() : $relModel
        {
            return \$this->{$relType}({$foreignModel}::class, '$referenceColumn', '$targetKey');\n";
        }\n
        PHP;

        return  $html;
    }

    public function getDescriptorColumn($table)
    {
        // FIXME: check implementation
        $fkColumns = collect($this->db->listTableForeignKeys($table))
            ->map(fn ($col) => $col->getColumns()[0])->values();
        // $indexColumns = collect($this->db->listTableIndexes($table))
        //     ->map(fn ($col, $key) => ['column' => $col->getColumns()[0], 'table' => $key]);
        $indexColumns = collect($this->db->listTableIndexes($table))
            ->filter(fn ($col, $key) => $key == 'primary')
            ->map(fn ($col) => $col->getColumns()[0])->values();

        $skipColumns = collect()
            ->merge($fkColumns)
            ->merge($indexColumns)
            ->merge($this->config->database->skipColumns)->unique();

        return $this->getColumns($table, $skipColumns)
            ->first(fn ($col) => !\Str::endsWith($col->getName(), '_id'));
    }

    public function generateFiles($generators)
    {
        foreach ($generators as $class) {
            $generator = new $class($this);
            $generator->generate();
            $this->newline();
        }
    }
}
