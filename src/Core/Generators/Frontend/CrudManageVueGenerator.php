<?php

namespace Rekamy\Generator\Core\Generators\Frontend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class CrudManageVueGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Vue Manage...");
        $this->tables = $this->context->getTables();
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating Vue Manage for Table $table ...");
                $name = Str::of($table)->singular();
                $data = [
                    // 'context' => $this->context,
                    'columns' => $this->context->getColumns($table),
                    'table' =>  $name,
                    'title' =>  $name->absoluteTitle(),
                    'studly' =>  $name->studly(),
                    'camel' => $name->camel(),
                    'slug' =>  $name->slug(),
                    // 'repoName' => $name->studly() . "Repository",
                    // 'requestName' => $name->studly() . "Request",
                ];

                $view = view('frontend::crud-vite/CrudManageVue', $data);

                $contextPath = $this->context->config->setup->frontend->path;
                $path = $contextPath->root . $contextPath->crud . $name->slug();
                $targetPath = base_path($path . '/pages/Manage' . $name->studly() . 'Page.vue');

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $targetPath
                );

                $stub->render();
                $this->context->info("Vue Manage for Table $table Created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
