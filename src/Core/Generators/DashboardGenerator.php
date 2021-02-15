<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class DashboardGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Dashboard file...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            
            $resources_path = resource_path();
            if(is_dir($resources_path . "/frontend")) {
                $this->context->info("Folder dashboard already exist. skip clone..");
                return;
            }

            $command =  "cd $resources_path && git clone git@gitlab.com:rekamy/packages/argon-template.git frontend";
            exec($command);
            $this->context->info("Installing dependency...");
            $command =  "cd $resources_path/frontend && npm i";
            exec($command);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
