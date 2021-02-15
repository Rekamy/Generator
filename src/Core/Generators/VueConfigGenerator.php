<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class VueConfigGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Config file...");
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

            $view = view('frontend::Argon/template/src/config/environment/indexTs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/config/environment/index.ts")
            );

            $stub->render();
            $this->context->info("Environment file Created.");
            $this->generateTyping();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateTyping()
    {
        try {
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/config/typings/tsshimsdTs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/config/typings/ts-shims.d.ts")
            );

            $view2 = view('frontend::Argon/template/src/config/typings/vueshimsdTs');

            $stub2 = new StubGenerator(
                $this->context,
                $view2->render(),
                resource_path("frontend/src/config/typings/vue-shims.d.ts")
            );

            $view3 = view('frontend::Argon/template/src/config/typings/vuexshimdTs');

            $stub3 = new StubGenerator(
                $this->context,
                $view3->render(),
                resource_path("frontend/src/config/typings/vuex-shim.d.ts")
            );

            $stub->render();
            $stub2->render();
            $stub3->render();
            $this->context->info("Typings file Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
