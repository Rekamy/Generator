<?php

namespace Rekamy\ApiGenerator\Console;

use DB;
use Rekamy\ApiGenerator\Console\Generator\AppBaseControllerGenerator;
use Rekamy\ApiGenerator\Console\Generator\BaseControllerGenerator;
use Rekamy\ApiGenerator\Console\Generator\ControllersGenerator;
use Rekamy\ApiGenerator\Console\Generator\ModelGenerator;
use Rekamy\ApiGenerator\Console\Generator\RepositoryGenerator;
use Rekamy\ApiGenerator\Console\Generator\RequestGenerator;
use Rekamy\ApiGenerator\Console\Generator\RouteGenerator;
use Debugbar;

class Context
{
    use ModelGenerator,
        ControllersGenerator,
        BaseControllerGenerator,
        AppBaseControllerGenerator,
        RepositoryGenerator,
        RequestGenerator,
        RouteGenerator;

    public $config;
    public $dbname;
    public $excludeTables = [];
    public $generate;
    public $path;
    public $options;
    public $namespace;
    public $appName;
    public $db = [];
    public $output = [];

    public function __construct()
    {
        $this->dbname = config('apigenerator.database.name', 'homestead');
        $this->excludeTables = config('apigenerator.database.exclude_tables', []);
        $this->generate = config('apigenerator.generate', false);
        $this->path = config('apigenerator.path');
        $this->options = config('apigenerator.options');
        $this->namespace = config('apigenerator.namespace');
        $this->appName = config('apigenerator.app_name');

        $this->db['context'] = $this;

        $this->db['columns'] = DB::table('information_schema.columns')
            ->where('table_schema', $this->dbname);
        $this->db['tables'] = DB::table('information_schema.tables')
            ->where('table_schema', $this->dbname);
        $this->db['constraints'] = DB::table('information_schema.key_column_usage')
            ->where('table_schema', $this->dbname)
            ->where('constraint_name', 'like', 'fk_%');
        $this->db['nullable'] = DB::table('column_name')
            ->from('information_schema.columns')
            ->where('is_nullable', 'NO')
            ->where('table_schema', $this->dbname);

        if (!empty($this->excludeTables)) {
            $this->db['columns']->whereNotIn('table_name', $this->excludeTables);
            $this->db['tables']->whereNotIn('table_name', $this->excludeTables);
            $this->db['constraints']->whereNotIn('table_name', $this->excludeTables);
            $this->db['nullable']->whereNotIn('table_name', $this->excludeTables);
        }

        $this->db['columns'] = $this->db['columns']->get();
        $this->db['tables'] = $this->db['tables']->get();
        $this->db['constraints'] = $this->db['constraints']->get();
        $this->db['nullable'] = $this->db['nullable']->get();
    }
}
