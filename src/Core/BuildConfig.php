<?php

namespace Rekamy\Generator\Core;

use DB;

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

        // FIXME: on migrate, schema manager does not get latest db struct
        $db = \DB::connection();
        $schema = $db->getDoctrineSchemaManager();

        $this->db = $schema;
    }

    // public function reloadTable()
    // {
    //     $db = \DB::connection();
    //     $schema = $db->getDoctrineSchemaManager();
    //     $this->db = $schema;
    // }
}
