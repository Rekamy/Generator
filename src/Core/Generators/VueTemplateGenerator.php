<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class VueTemplateGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Src base...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/appVue');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/App.vue")
            );

            $stub->render();
            $this->context->info("App.vue file Created.");
            $this->generateMain();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateMain()
    {
        try {
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/mainTs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/main.ts")
            );

            $stub->render();
            $this->context->info("Main.ts file Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
