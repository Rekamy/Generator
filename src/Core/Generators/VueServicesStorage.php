<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class VueServicesStorage
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Services Storage file...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $data['modules'][] = Str::of($table)->singular();
            }

            $data['context'] = $this->context;

            $view = view('frontend::ServicesStorageTs', $data);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/services/storage/index.ts")
            );

            $stub->render();
            $this->context->info("Frontend Services Storage Index created.");

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
