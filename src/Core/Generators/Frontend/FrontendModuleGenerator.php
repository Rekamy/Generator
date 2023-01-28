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
    }

    public function generate()
    {
        foreach ($this->context->tables as $table) {
            $this->generateBaseRoute($table);
            $this->generateModel($table);
            $this->generateTable($table);
        }
        // $this->enableModules();
    }

    private function generateBaseRoute($table)
    {
        $this->context->info("Creating Frontend Module Route for table $table ...");
        $data['context'] = $this->context;
        $name = Str::of($table)->singular();
        $data['table'] = $name;
        $data['title'] =  $name->absoluteTitle();
        $data['camel'] = $name->camel();
        $data['slug'] =  $name->slug();
        $data['studly'] =  $name->studly();
        $data['columns'] = $this->context->getColumns($table);

        $view = view('frontend::modules-vite/routeTSVite', $data);

        $contextPath = $this->context->config->setup->frontend->path;
        $path = $contextPath->root . $contextPath->crud . $name->slug();
        $targetPath = base_path($path . '/router.ts');

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            $targetPath
        );

        $stub->render();
        $this->context->info("Frontend Module Model for table $table created.");
    }

    private function getSkipColumns($table)
    {
        $fkColumns = collect($this->context->db->listTableForeignKeys($table))->map(fn ($col) => $col->getColumns()[0])->values();
        $indexColumns = collect($this->context->db->listTableIndexes($table))->map(fn ($col) => $col->getColumns()[0])->values();
        return collect()
            ->merge($fkColumns)
            ->merge($indexColumns)
            ->merge($this->context->config->database->skipColumns)->unique()
            ->toArray();
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


        $data['columns'] = $this->context->getColumns($table);
        $data['imports'] = [];
        $additional = $this->context->relations->where('table', $table)
            ->whereNotIn('foreignModel', $this->context->config->database->skipColumns);
        $additionalAttributes = $additional->where('relType', 'belongsTo');

        $additionalArray = $additional->where('relType', 'hasMany');

        $data['additionalAttributes'] = $additionalAttributes->pluck('foreignModel', 'relName')->toArray();

        $data['additionalArray'] = $additionalArray->pluck('foreignModel', 'relName')->toArray();

        foreach ($additional->pluck("foreignModel") as $key => $value) {
            $path = Str::of($value)->kebab();
            $data['imports'][] = "import { {$value} } from '@/modules/{$path}/blocs/{$path}.model';";
        }

        $view = view('frontend::modules-vite/modelTSVite', $data);

        $contextPath = $this->context->config->setup->frontend->path;
        $path = $contextPath->root . $contextPath->crud . $name->slug();
        $targetPath = base_path($path . '/blocs/model.ts');

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            $targetPath
        );

        $stub->render();
        $this->context->info("Frontend Module Model for table $table created.");
    }

    private function generateTable($table)
    {
        $this->context->info("Creating Bloc for table $table ...");

        $data['context'] = $this->context;
        $name = Str::of($table)->singular();
        $data['table'] = $name;
        $data['title'] =  $name->absoluteTitle();
        $data['camel'] = $name->camel();
        $data['slug'] =  $name->slug();
        $data['studly'] =  $name->studly();
        $data['lower'] =  $name->studly()->lower();
        $data['plural'] =  $name->studly()->plural()->lower();
        $data['slugPlural'] =  $name->plural()->lower()->slug();

        $data['columns'] = $this->context->getColumns($table, $this->getSkipColumns($table));

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
        $view = view('frontend::modules-vite/tableTSVite', $data);

        $contextPath = $this->context->config->setup->frontend->path;
        $path = $contextPath->root . $contextPath->crud . $name->slug();
        $targetPath = base_path($path . '/blocs/table.ts');

        $stub = new StubGenerator(
            $this->context,
            $view->render(),
            $targetPath
        );

        $stub->render();
        $this->context->info("Bloc for table $table created.");
    }

}
