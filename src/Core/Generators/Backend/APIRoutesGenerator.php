<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class APIRoutesGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating APIRoutes...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            $data = [
                'routes' => [],
            ];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = [
                    "className" => Str::of($table)->singular()->studly() . "Controller",
                    "routeName" => Str::of($table)->singular()->slug()
                ];
            }

            $view = view('backend::routes.CrudAPIRoutes', $data);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['crud_routes']
            );

            $stub->render();
            $this->context->info("Api Route Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function authRoutes()
    {
        try {

            $view = view('backend::routes.AuthAPIRoutes');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['api_routes']
            );

            $stub->render();
            $this->context->info("Api Route Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function crudRoutes()
    {
        try {
            $data = [
                'routes' => [],
            ];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = [
                    "className" => Str::of($table)->singular()->studly() . "Controller",
                    "routeName" => Str::of($table)->singular()->slug()
                ];
            }

            $view = view('backend::routes.CrudAPIRoutes', $data);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['crud_routes']
            );

            $stub->render();
            $this->context->info("Api Route Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
