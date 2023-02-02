<?php

namespace Rekamy\Generator\Core\Generators\Frontend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class CrudViewVueGenerator
{
    private $context;

    private $tables;

    private $frontendName;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Vue View...");
        $this->tables = $this->context->getTables();
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating Vue View for table $table ...");

                $name = Str::of($table)->singular();
                $data = [
                    'columns' => $this->context->getColumns($table),
                    'table' =>  $name,
                    'camel' =>  $name->camel(),
                    'title' =>  $name->headline(),
                    'slug' =>  $name->slug(),
                    'studly' =>  $name->studly(),
                ];

                $view = view('frontend::crud-vite/CrudViewVue', $data);

                $contextPath = $this->context->config->setup->frontend->path;
                $path = $contextPath->root . $contextPath->crud . $name->slug();
                $targetPath = base_path($path . '/pages/View' . $name->studly() . 'Page.vue');

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $targetPath
                );

                $stub->render();
                $this->context->info("Vue View for table $name created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
