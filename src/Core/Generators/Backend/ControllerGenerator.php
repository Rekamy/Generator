<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class ControllerGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Controller...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating Controller for table $table ...");
                $name = Str::of($table);
                $data['context'] = $this->context;
                $data['table'] = $name;
                $data['slug'] = $name->slug();
                $data['snake'] = $name->snake();
                $data['className'] = $name->singular()->studly() . "Controller";
                $data['blocName'] = $name->singular()->studly() . "Bloc";

                $view = view('backend::controller.Controller', $data);

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $this->context->path['backend']['controller']['path'] . $data['className'] . '.php'
                );

                $stub->render();
                $this->context->info("Controller Created.");
                $this->resources();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function resources()
    {
        try {
            $view = view('backend::UserProfileResource')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                app_path('Http/Resources/') . 'UserProfileResource.php'
            );

            $stub->render();
            $this->context->info("User Profile Resource Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
