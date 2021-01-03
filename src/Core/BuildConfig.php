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
        if (!config('rekamygenerator')) {
            $this->configFile = include __DIR__ . '/../config/rekamygenerator.php';
            $this->dbname = config('database.connections.mysql.database');
            $this->excludeTables = $this->configFile['database']['exclude_tables'];
            $this->generate = $this->configFile['generate'];
            $this->path = $this->configFile['path'];
            $this->options = collect($this->configFile['options']);
            $this->namespace = $this->configFile['namespace'];
            $this->appName = $this->configFile['app_name'];
            $this->template = $this->configFile['template'];
        } else {
            $this->configFile = config('rekamygenerator');
            $this->dbname = config('rekamygenerator.database.name');
            $this->excludeTables = config('rekamygenerator.database.exclude_tables');
            $this->generate = config('rekamygenerator.generate');
            $this->path = config('rekamygenerator.path');
            $this->options = collect(config('rekamygenerator.options'));
            $this->namespace = config('rekamygenerator.namespace');
            $this->appName = config('rekamygenerator.app_name');
            $this->template = config('rekamygenerator.template');
        }

        $db = \DB::connection();
        $schema = $db->getDoctrineSchemaManager();

        $this->db = $schema;
    }

}
