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
    public $configFile = [];
    public $outputDecorator;
    public $progress;

    public function loadConfig()
    {
        $this->configFile = config('rekamygenerator');
        $this->dbname = config('rekamygenerator.database.name');
        $this->excludeTables = config('rekamygenerator.database.exclude_tables');
        $this->generate = config('rekamygenerator.generate');
        $this->path = config('rekamygenerator.path');
        $this->options = collect(config('rekamygenerator.options'));
        $this->namespace = config('rekamygenerator.namespace');
        $this->appName = config('rekamygenerator.app_name');
        $this->template = config('rekamygenerator.template');

        $db = \DB::connection();
        $schema = $db->getDoctrineSchemaManager();

        $this->db = $schema;
    }
}
