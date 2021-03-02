<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class FrontendModuleGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Frontend Module...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            $this->generateBaseIndex();
            foreach ($this->tables as $table) {
                $this->generateApi($table);
                $this->generateBloc($table);
                $this->generateModel($table);
                $this->generateStore($table);
                $this->generateIndex($table);
                $this->generateAuth();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function generateApi($table)
    {
        $this->context->info("Creating Api for table $table ...");

        $data['context'] = $this->context;
        $name = Str::of($table)->singular();
        $data['table'] = $name;
        $data['title'] =  $name->title();
        $data['camel'] = $name->camel();
        $data['slug'] =  $name->slug();
        $data['studly'] =  $name->studly();
        $data['columns'] = collect($this->context->db->listTableColumns($table))
            ->except([
                'id', 'created_at', 'updated_at', 'created_by', 'updated_by',
                'deleted_at', 'deleted_by', 'remark',
            ]);

        $view = view('frontend::modules/apiTS', $data);

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path("frontend/src/modules/{$name}/api.ts")
        );

        $stub->render();
        $this->context->info("Api for table $table created.");
    }

    private function generateBloc($table)
    {
        $this->context->info("Creating Bloc for table $table ...");

        $data['context'] = $this->context;
        $name = Str::of($table)->singular();
        $data['table'] = $name;
        $data['title'] =  $name->title();
        $data['camel'] = $name->camel();
        $data['slug'] =  $name->slug();
        $data['studly'] =  $name->studly();
        $data['columns'] = collect($this->context->db->listTableColumns($table))
            ->except([
                'id', 'created_at', 'updated_at', 'created_by', 'updated_by',
                'deleted_at', 'deleted_by', 'remark',
            ]);

        $view = view('frontend::modules/blocTS', $data);

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path("frontend/src/modules/{$name}/bloc.ts")
        );

        $stub->render();
        $this->context->info("Bloc for table $table created.");
    }

    private function generateModel($table)
    {
        $this->context->info("Creating Frontend Module Model for table $table ...");

        $data['context'] = $this->context;
        $name = Str::of($table)->singular();
        $data['table'] = $name;
        $data['title'] =  $name->title();
        $data['camel'] = $name->camel();
        $data['slug'] =  $name->slug();
        $data['studly'] =  $name->studly();
        $data['columns'] = collect($this->context->db->listTableColumns($table))
            ->except([
                'id', 'created_at', 'updated_at', 'created_by', 'updated_by',
                'deleted_at', 'deleted_by', 'remark',
            ]);

        $view = view('frontend::modules/modelTS', $data);

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path("frontend/src/modules/{$name}/model.ts")
        );

        $stub->render();
        $this->context->info("Frontend Module Model for table $table created.");
    }

    private function generateStore($table)
    {
        $this->context->info("Creating Frontend Module Store for table $table ...");

        $data['context'] = $this->context;
        $name = Str::of($table)->singular();
        $data['table'] = $name;
        $data['title'] =  $name->title();
        $data['camel'] = $name->camel();
        $data['slug'] =  $name->slug();
        $data['studly'] =  $name->studly();
        $data['columns'] = collect($this->context->db->listTableColumns($table))
            ->except([
                'id', 'created_at', 'updated_at', 'created_by', 'updated_by',
                'deleted_at', 'deleted_by', 'remark',
            ]);

        $view = view('frontend::modules/storeTS', $data);

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path("frontend/src/modules/{$name}/store.ts")
        );

        $stub->render();
        $this->context->info("Frontend Module Store for table $table created.");
    }

    private function generateIndex($table)
    {
        $this->context->info("Creating Frontend Module Index for table $table ...");

        $data['context'] = $this->context;
        $name = Str::of($table)->singular();
        $data['table'] = $name;
        $data['title'] =  $name->title();
        $data['camel'] = $name->camel();
        $data['slug'] =  $name->slug();
        $data['studly'] =  $name->studly();
        $data['columns'] = collect($this->context->db->listTableColumns($table))
            ->except([
                'id', 'created_at', 'updated_at', 'created_by', 'updated_by',
                'deleted_at', 'deleted_by', 'remark',
            ]);

        $view = view('frontend::modules/indexTS', $data);

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path("frontend/src/modules/{$name}/index.ts")
        );

        $stub->render();
        $this->context->info("Frontend Module Index for table $table created.");
    }

    private function generateBaseIndex()
    {
        $this->context->info("Creating Frontend Module Base Index ...");

        foreach ($this->tables as $table) {
            $data['modules'][] = Str::of($table)->singular();
        }

        $data['context'] = $this->context;
        $view = view('frontend::modules/BaseindexTS', $data);

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path("frontend/src/modules/index.ts")
        );

        $stub->render();
        $this->context->info("Frontend Module Base Index created.");
    }

    private function generateAuth()
    {
        $this->context->info("Creating Frontend Module Auth ...");

        foreach ($this->tables as $table) {
            $data['modules'][] = Str::of($table)->singular();
        }

        $data['context'] = $this->context;

        $view = view('frontend::modules/auth/apiTS', $data);

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path("frontend/src/modules/auth/api.ts")
        );

        $view2 = view('frontend::modules/auth/blocTS', $data);

        $stub2 = new StubGenerator(
            $this->context,
            $view2->render(),
            resource_path("frontend/src/modules/auth/bloc.ts")
        );

        $view3 = view('frontend::modules/auth/indexTS', $data);

        $stub3 = new StubGenerator(
            $this->context,
            $view3->render(),
            resource_path("frontend/src/modules/auth/index.ts")
        );

        $data['routes'] = [];
        foreach ($this->tables as $key => $table) {
            $data['routes'][] = Str::of($table)->singular();
        }

        $view4 = view('frontend::modules/auth/modelTs', $data);

        $stub4 = new StubGenerator(
            $this->context,
            $view4->render(),
            resource_path("frontend/src/modules/auth/model.ts")
        );

        $view5 = view('frontend::modules/auth/storeTs', $data);

        $stub5 = new StubGenerator(
            $this->context,
            $view5->render(),
            resource_path("frontend/src/modules/auth/store.ts")
        );

        $stub->render();
        $stub2->render();
        $stub3->render();
        $stub4->render();
        $stub5->render();
        $this->context->info("Frontend Module Auth created.");
    }
}
