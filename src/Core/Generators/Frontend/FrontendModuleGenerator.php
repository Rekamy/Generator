<?php

namespace Rekamy\Generator\Core\Generators\Frontend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
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
                if (!empty($this->context->includeTables))
                    return !in_array($item, $this->context->excludeTables) && in_array($item, $this->context->includeTables);

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
            }
            // $this->generateAuth();
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
        $data['title'] =  $name->absoluteTitle();
        $data['camel'] = $name->camel();
        $data['slug'] =  $name->slug();
        $data['studly'] =  $name->studly();
        $data['columns'] = collect($this->context->db->listTableColumns($table))
            ->except($this->context->database['skipColumns']);

        $view = view('frontend::modules/apiTS', $data);

        $target = $this->context->template['frontend_path'] . $this->context->path['frontend']['module']['path'];

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path($target) . "/$name/api.ts"
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
        $data['title'] =  $name->absoluteTitle();
        $data['camel'] = $name->camel();
        $data['slug'] =  $name->slug();
        $data['studly'] =  $name->studly();

        $fkColumns = collect($this->context->db->listTableForeignKeys($table))->map(fn ($col) => $col->getColumns()[0])->values();
        $indexColumns = collect($this->context->db->listTableIndexes($table))->map(fn ($col) => $col->getColumns()[0])->values();
        $skipColumns = collect()
            ->merge($fkColumns)
            ->merge($indexColumns)
            ->merge($this->context->database['skipColumns'])->unique();

        $data['columns'] = collect($this->context->db->listTableColumns($table))
            ->except($skipColumns->toArray());
        $relColumns = [];
        $this->context->relations->where('table', $table)->where('relType', 'belongsTo')
            ->each(function ($relation) use ($table, &$relColumns) {
                // FIXME: check implementation
                $descriptorColumn = $this->context->getDescriptorColumn($table);
                if ($descriptorColumn) {
                    $relColumns[$relation['relName']] = $relation['relName'] . '.' . $descriptorColumn->getName();
                }
            });

        $data['relationColumns'] = $relColumns;
        $view = view('frontend::modules/blocTS', $data);

        $target = $this->context->template['frontend_path'] . $this->context->path['frontend']['module']['path'];

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path($target) . "/$name/bloc.ts"
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
        $data['title'] =  $name->absoluteTitle();
        $data['camel'] = $name->camel();
        $data['slug'] =  $name->slug();
        $data['studly'] =  $name->studly();
        $data['columns'] = collect($this->context->db->listTableColumns($table))
            ->except($this->context->database['skipColumns']);
        $data['imports'] = [];
        $additional = $this->context->relations->where('table', $table)->whereNotIn('foreignModel' , $this->context->database['skipColumns']);
        $additionalAttributes = $additional->where('relType', 'belongsTo');

        $additionalArray = $additional->where('relType', 'hasMany');

        $data['additionalAttributes'] = $additionalAttributes->pluck('foreignModel', 'relName')->toArray();

        $data['additionalArray'] = $additionalArray->pluck('foreignModel', 'relName')->toArray();
        $data['imports'][] = "import { {$additional->pluck("foreignModel")->implode(', ')} } from '@/modules';";

        $view = view('frontend::modules/modelTS', $data);

        $target = $this->context->template['frontend_path'] . $this->context->path['frontend']['module']['path'];

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path($target) . "/$name/model.ts"
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
        $data['title'] =  $name->absoluteTitle();
        $data['camel'] = $name->camel();
        $data['slug'] =  $name->slug();
        $data['studly'] =  $name->studly();
        $data['columns'] = collect($this->context->db->listTableColumns($table))
            ->except($this->context->database['skipColumns']);

        $view = view('frontend::modules/storeTS', $data);

        $target = $this->context->template['frontend_path'] . $this->context->path['frontend']['module']['path'];

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path($target) . "/$name/store.ts"
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
        $data['title'] =  $name->absoluteTitle();
        $data['camel'] = $name->camel();
        $data['slug'] =  $name->slug();
        $data['studly'] =  $name->studly();
        $data['columns'] = collect($this->context->db->listTableColumns($table))
            ->except($this->context->database['skipColumns']);

        $view = view('frontend::modules/indexTS', $data);

        $target = $this->context->template['frontend_path'] . $this->context->path['frontend']['module']['path'];
        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path($target) . "/$name/index.ts"
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

        $target = $this->context->template['frontend_path'] . $this->context->path['frontend']['module']['path'];

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path($target) . "/index.ts"
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

        $target = $this->context->template['frontend_path'] . $this->context->path['frontend']['module']['path'];

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            resource_path($target) . "/auth/api.ts"
        );

        $view2 = view('frontend::modules/auth/blocTS', $data);

        $stub2 = new StubGenerator(
            $this->context,
            $view2->render(),
            resource_path($target) . "/auth/bloc.ts"
        );

        $view3 = view('frontend::modules/auth/indexTS', $data);

        $stub3 = new StubGenerator(
            $this->context,
            $view3->render(),
            resource_path($target) . "/auth/index.ts"
        );

        $data['routes'] = [];
        foreach ($this->tables as $table) {
            $data['routes'][] = Str::of($table)->singular();
        }

        $view4 = view('frontend::modules/auth/modelTs', $data);

        $stub4 = new StubGenerator(
            $this->context,
            $view4->render(),
            resource_path($target) . "/auth/model.ts"
        );

        $view5 = view('frontend::modules/auth/storeTs', $data);

        $stub5 = new StubGenerator(
            $this->context,
            $view5->render(),
            resource_path($target) . "/auth/store.ts"
        );

        $stub->render();
        $stub2->render();
        $stub3->render();
        $stub4->render();
        $stub5->render();
        $this->context->info("Frontend Module Auth created.");
    }
}
