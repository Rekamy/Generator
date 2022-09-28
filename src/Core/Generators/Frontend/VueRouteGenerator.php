<?php

namespace Rekamy\Generator\Core\Generators\Frontend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class VueRouteGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Route file...");
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
            $frontendName = $this->context->template['frontend_path'];
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] =  [
                    'camel' =>Str::of($table)->camel(),
                    'kebab' =>Str::of($table)->camel()->singular()->kebab(),
                ];
            }

            $view = view('frontend::routevite', $data);
            
            $target = $this->context->template['frontend_path'];

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                base_path() . '/Modules/VueTest/Resources/' . $frontendName . "/router.ts"
            );

            // dd(base_path() . '/Modules/VueTest/Resources/' . $frontendName . "/router.ts");

            $stub->render();
            $this->context->info("Crud Route file Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
