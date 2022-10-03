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
        $this->frontendName = $this->context->template['frontend_path'];
        $this->context->info("Creating Vue View...");
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
                $this->context->info("Creating Vue View for table $table ...");

                // $data['context'] = $this->context;
                // $data['table'] = $table;
                $name = Str::of($table)->singular();
                $data['columns'] = collect($this->context->db->listTableColumns($table))
                    ->except([
                        'id', 'created_at', 'updated_at', 'created_by', 'updated_by',
                        'deleted_at', 'deleted_by', 'remark',
                    ]);
                $data['table'] =  $name;
                $data['camel'] =  $name->camel();
                $data['title'] =  $name->absoluteTitle();
                $data['slug'] =  $name->slug();
                $data['studly'] =  $name->studly();
                // $data['repoName'] = $name->singular()->studly() . "Repository";
                // $data['requestName'] = $name->singular()->studly() . "Request";

                $view = view('frontend::crud-vite/CrudViewVue', $data);

                // $target = $this->context->template['frontend_path'] . $this->context->path['frontend']['crud']['path'];

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    base_path() . '/Modules/VueTest/Resources/vue3/src/modules/crud-generator/' . $data['slug'] . '/pages/View' . $data['studly'] . 'Page.vue'
                    // resource_path($target) . "/$name/view.vue"
                );

                $stub->render();
                $this->context->info("Vue View for table $name created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
