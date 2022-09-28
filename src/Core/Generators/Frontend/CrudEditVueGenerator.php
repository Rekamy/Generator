<?php

namespace Rekamy\Generator\Core\Generators\Frontend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class CrudEditVueGenerator
{
    private $context;

    private $tables;

    private $frontendName;

    public function __construct($context)
    {
        $this->context = $context;
        $this->frontendName = $this->context->template['frontend_path'];
        $this->context->info("Creating Vue Edit...");
        // $this->tables = collect($this->context->db->listTableNames())
        //     ->filter(function ($item) {
        //         return !in_array($item, $this->context->excludeTables);
        //     });

        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                if (str_starts_with($item, 'staff'))
                    return $item;
            });
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating Vue Edit for Table $table ...");

                // $data['context'] = $this->context;
                $name = Str::of($table)->singular();
                $data['columns'] = collect($this->context->db->listTableColumns($table))
                    ->except([
                        'id', 'created_at', 'updated_at', 'created_by', 'updated_by',
                        'deleted_at', 'deleted_by', 'remark',
                    ]);
                $data['table'] =  $name;
                $data['title'] =  $name->absoluteTitle();
                $data['slug'] =  $name->slug();
                $data['camel'] =  $name->camel();
                $data['studly'] =  $name->studly();
                // $data['repoName'] = Str::of($table)->singular()->studly() . "Repository";
                // $data['requestName'] = Str::of($table)->singular()->studly() . "Request";

                $view = view('frontend::crud-vite/CrudEditVue', $data);

                $target = $this->context->template['frontend_path'] . $this->context->path['frontend']['crud']['path'];

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    base_path() . '/Modules/VueTest/Resources/' . $this->frontendName . '/modules/' . $data['slug'] . '/pages/Edit' . $data['studly'] . 'Page.vue'
                    // resource_path($target) . "/$name/edit.vue"

                );

                $stub->render();
                $this->context->info("Vue Edit for Table $table Created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
