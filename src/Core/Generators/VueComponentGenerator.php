<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class VueComponentGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Components file...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            $this->context->info("Base file Created.");
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/components/base/badge/indexTs');


            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/components/base/badge/index.ts")
            );

            // $view = view('frontend::Argon/template/src/components/base/badge/templateVue');


            // $stub = new StubGenerator(
            //     $this->context,
            //     $view->render(),
            //     resource_path("frontend/src/components/base/badge/template.vue")
            // );

            $stub->render();
            $this->context->info("Badge file Created.");
            $this->generateCard();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateCard()
    {
        try {
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/components/base/card/indexTs');


            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/components/base/card/index.ts")
            );

            $vieww = view('frontend::Argon/template/src/components/base/card/templateVue');


            $stubb = new StubGenerator(
                $this->context,
                $vieww->render(),
                resource_path("frontend/src/components/base/card/template.vue")
            );

            $stub->render();
            $stubb->render();
            $this->context->info("Card file Created.");
            $this->generateDropzone();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateDropzone()
    {
        try {
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/components/base/dropzone/dropzonefileuploadVue');


            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/components/base/dropzone/DropzoneFileUpload.vue")
            );

            $stub->render();
            $this->context->info("Dropzone file Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateStats()
    {
        try {
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/components/base/stats/statsTs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/components/base/stats/stats.ts")
            );

            $view2 = view('frontend::Argon/template/src/components/base/stats/statsTs');

            $stub2 = new StubGenerator(
                $this->context,
                $view2->render(),
                resource_path("frontend/src/components/base/stats/stats.ts")
            );

            $stub->render();
            $stub2->render();
            $this->context->info("Stats file Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
