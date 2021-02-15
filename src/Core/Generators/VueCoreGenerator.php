<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class VueCoreGenerator
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
            $this->context->info("Components file Created.");
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/core/components/datatable/assetsTs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/core/components/datatable/assets.ts")
            );

            $view2 = view('frontend::Argon/template/src/core/components/datatable/builderTs');

            $stub2 = new StubGenerator(
                $this->context,
                $view2->render(),
                resource_path("frontend/src/core/components/datatable/builder.ts")
            );

            $view3 = view('frontend::Argon/template/src/core/components/datatable/contractTs');

            $stub3 = new StubGenerator(
                $this->context,
                $view3->render(),
                resource_path("frontend/src/core/components/datatable/contract.ts")
            );

            $view4 = view('frontend::Argon/template/src/core/components/datatable/indexTs');

            $stub4 = new StubGenerator(
                $this->context,
                $view4->render(),
                resource_path("frontend/src/core/components/datatable/index.ts")
            );

            $view5 = view('frontend::Argon/template/src/core/components/datatable/propsTs');

            $stub5 = new StubGenerator(
                $this->context,
                $view5->render(),
                resource_path("frontend/src/core/components/datatable/props.ts")
            );

            $view6 = view('frontend::Argon/template/src/core/components/datatable/templateVue');

            $stub6 = new StubGenerator(
                $this->context,
                $view6->render(),
                resource_path("frontend/src/core/components/datatable/template.vue")
            );

            $stub->render();
            $stub2->render();
            $stub3->render();
            $stub4->render();
            $stub5->render();
            $stub6->render();
            $this->context->info("Datatable file Created.");
            $this->generateSelect();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateSelect()
    {
        try {
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/core/components/select2/builderTs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/core/components/select2/builder.ts")
            );

            $view2 = view('frontend::Argon/template/src/core/components/select2/indexTs');

            $stub2 = new StubGenerator(
                $this->context,
                $view2->render(),
                resource_path("frontend/src/core/components/select2/index.ts")
            );

            $view3 = view('frontend::Argon/template/src/core/components/select2/templateVue');

            $stub3 = new StubGenerator(
                $this->context,
                $view3->render(),
                resource_path("frontend/src/core/components/select2/template.vue")
            );

            $stub->render();
            $stub2->render();
            $stub3->render();
            $this->context->info("Select2 file Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generatePlugins()
    {
        try {
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/core/components/select2/builderTs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/core/components/select2/builder.ts")
            );

            $stub->render();
            $this->context->info("Select2 file Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
