<?php

namespace Rekamy\Generator\Console;

use DB;
use Rekamy\Generator\Console\Generator\AppBaseControllerGenerator;
use Rekamy\Generator\Console\Generator\BaseControllerGenerator;
use Rekamy\Generator\Console\Generator\ApiControllersGenerator;
use Rekamy\Generator\Console\Generator\ModelGenerator;
use Rekamy\Generator\Console\Generator\RepositoryGenerator;
use Rekamy\Generator\Console\Generator\ApiRequestGenerator;
use Rekamy\Generator\Console\Generator\WebRequestGenerator;
use Rekamy\Generator\Console\Generator\ApiRouteGenerator;
use Rekamy\Generator\Console\Generator\RobustModuleViewGenerator;
use Rekamy\Generator\Console\Generator\WebRouteGenerator;
use Rekamy\Generator\Console\Generator\WebControllersGenerator;
use Rekamy\Generator\Console\Generator\SwaggerApiDocGenerator;
use Rekamy\Generator\GeneratorServiceProvider;

class Context extends GeneratorServiceProvider
{
    use ModelGenerator,
        ApiControllersGenerator,
        BaseControllerGenerator,
        AppBaseControllerGenerator,
        RepositoryGenerator,
        ApiRequestGenerator,
        ApiRouteGenerator,
        WebControllersGenerator,
        WebRequestGenerator,
        RobustModuleViewGenerator,
        WebRouteGenerator,
        SwaggerApiDocGenerator;

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
    public $output = [];
    public $configFile = [];
    public $outputDecorator;
    public $progress;

    public function loadConfig()
    {
        if (!config('rekamygenerator')) {
            $this->configFile = include __DIR__ . '/../config/rekamygenerator.php';
            $config = config('database');
            $this->dbname = $config['connections']['mysql']['database'];
            $this->excludeTables = $this->configFile['database']['exclude_tables'];
            $this->generate = $this->configFile['generate'];
            $this->path = $this->configFile['path'];
            $this->options = $this->configFile['options'];
            $this->namespace = $this->configFile['namespace'];
            $this->appName = $this->configFile['app_name'];
            $this->template = $this->configFile['template'];
        } else {
            $this->configFile = config('rekamygenerator');
            $this->dbname = config('rekamygenerator.database.name');
            $this->excludeTables = config('rekamygenerator.database.exclude_tables');
            $this->generate = config('rekamygenerator.generate');
            $this->path = config('rekamygenerator.path');
            $this->options = config('rekamygenerator.options');
            $this->namespace = config('rekamygenerator.namespace');
            $this->appName = config('rekamygenerator.app_name');
            $this->template = config('rekamygenerator.template');
        }
    }

    public function __construct()
    {
        $this->loadConfig();

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
