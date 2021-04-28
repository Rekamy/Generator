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
        $this->dbname = $this->config['database']['name'];
        $this->excludeTables = $this->config['database']['exclude_tables'];
        $this->generate = $this->config['generate'];
        $this->path = $this->config['path'];
        $this->options = collect($this->config['options']);
        $this->namespace = $this->config['namespace'];
        $this->appName = $this->config['app_name'];
        $this->template = $this->config['template'];
        $this->frontPath = $this->config['template'];

        $db = \DB::connection();
        $schema = $db->getDoctrineSchemaManager();

        $this->db = $schema;
    }
}
