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

            $view = view('frontend::route', $data);

            $target = $this->context->template['frontend_path'] . $this->context->path['frontend']['route'];

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path($target) . "/crud.ts"
            );

            $stub->render();
            $this->context->info("Crud Route file Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
