<?php

namespace Rekamy\Generator\Core\Generators\Frontend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
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

            $useLocal = true;
            $frontendName = 'frontend';
            $gitTemplate = "git@gitlab.com:rekamy/packages/argon-template.git";

            if (!empty($this->context->template['frontend_path']))
                $frontendName = $this->context->template['frontend_path'];

            if (!empty($this->context->template['source']) && !$useLocal) {
                $gitTemplate = $this->context->template['source'];
            } else {
                $gitTemplate = 'C:\Users\kidzen\Data\server\www\packages\argon-template';
            }

            $resourcesPath = resource_path();
            $frontendPath = resource_path($frontendName);

            if (is_dir($frontendPath)) {
                $this->context->info("Folder dashboard already exist. skip clone..");
                if (!file_exists($frontendPath . '/.env'))
                    copy($frontendPath . '/.env.example', $frontendPath . '/.env');
                return;
            }
            
            if($useLocal) {
                $command =  "cp -r '$gitTemplate' '$resourcesPath\\$frontendName' ";
                exec($command);
            } else {
                $command =  "cd $resourcesPath && git clone --depth=1 $gitTemplate $frontendName";
                exec($command);
            }
            $this->context->info("Installing dependency...");

            $command =  "cd $frontendPath && rm -rf .git";
            exec($command);

            $packageManager = $this->context->config['package_manager'];
            $command =  "cd $frontendPath && $packageManager install";
            exec($command);

            if (!file_exists($frontendPath . '/.env'))
                copy($frontendPath . '/.env.example', $frontendPath . '/.env');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
