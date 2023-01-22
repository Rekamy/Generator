<?php

namespace Rekamy\Generator\Core\Generators\Frontend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class CrudCreateVueGenerator
{
    private $context;

    private $tables;


    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Vue Create...");
        $this->tables = $this->context->getTables();
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating Vue Create for Table $table ...");

                $name = Str::of($table)->singular();
                $data = [
                    'columns' => $this->context->getColumns($table),
                    'table' =>  $name,
                    'camel' =>  $name->camel(),
                    'studly' =>  $name->studly(),
                    'title' =>  $name->absoluteTitle(),
                    'slug' =>  $name->slug(),
                ];

                $view = view('frontend::crud-vite/CrudCreateVue', $data);

                $contextPath = $this->context->config->setup->frontend->path;
                $path = $contextPath->root . $contextPath->crud . $name->slug();
                $targetPath = base_path($path . '/pages/Create' . $name->studly() . 'Page.vue');

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $targetPath
                );

                $stub->render();
                $this->context->info("Vue Create for Table $table Created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
