<?php

namespace Rekamy\Generator\Core\Generators\Frontend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class CrudEditTSGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating TS Edit...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating TS Edit for Table $table ...");

                $data['context'] = $this->context;
                $name = Str::of($table)->singular();
                $data['table'] = $name;
                $data['title'] =  $name->absoluteTitle();
                $data['camel'] = $name->camel();
                $data['slug'] =  $name->slug();
                $data['studly'] =  $name->studly();
                $data['columns'] = collect($this->context->db->listTableColumns($table))
                    ->except([
                        'id', 'created_at', 'updated_at', 'created_by', 'updated_by',
                        'deleted_at', 'deleted_by', 'remark',
                    ]);
                $data['className'] = $name->studly() . "Bloc";
                $data['repoName'] = $name->studly() . "Repository";
                $data['requestName'] = $name->studly() . "Request";

                $view = view('frontend::crud-flat/CrudEditTS', $data);

                $target = $this->context->template['frontend_path'] . $this->context->path['frontend']['crud']['path'];

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    resource_path($target) . "/$name/edit.ts"
                );

                $stub->render();
                $this->context->info("TS Edit for Table $table Created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
