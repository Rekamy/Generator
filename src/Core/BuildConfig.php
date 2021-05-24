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
    public $namespace;
    public $appName;
    public $template;
    public $db = [];
    // public $output = [];
    public $outputDecorator;
    public $progress;
    public $relations;

    public function loadConfig()
    {
        $this->config = config('rekamygenerator');
        $this->database = $this->config['database'];
        $this->dbname = $this->database['name'];
        $this->path = $this->config['path'];
        $this->generate = $this->config['generate'];
        $this->options = collect($this->config['options']);
        $this->namespace = $this->config['namespace'];
        $this->appName = $this->config['app_name'];
        $this->template = $this->config['template'];
        $this->frontPath = $this->config['template'];

        $this->excludeTables = $this->database['exclude_tables'];
        $this->includeTables = $this->database['include_tables'];

        $this->relations = collect();

        // FIXME: on migrate, schema manager does not get latest db struct
        $db = \DB::connection();
        $schema = $db->getDoctrineSchemaManager();

        $this->db = $schema;

        $this->tables = collect($this->db->listTableNames())
            ->filter(fn ($item) =>  !in_array($item, $this->excludeTables));

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
        $referenceColumn = $detail['referenceColumn'];
        $targetKey = $detail['targetKey'];

        $html = "\tpublic function $relName()\n";
        $html .= "\t{\n";
        $html .= "\t\treturn \$this->{$relType}({$foreignModel}::class, '$referenceColumn', '$targetKey');\n";
        $html .= "\t}\n";

        return  $html;
    }
}
