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
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/components/globalcomponentTs');


            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/components/globalComponents.ts")
            );

            $stub->render();
            $this->context->info("Base file Created.");
            $this->generateBadge();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateBadge()
    {
        try {
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
            $this->generateStats();
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
            $this->generateLayouts();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateLayouts()
    {
        try {
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/components/layouts/loginfooterVue');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/components/layouts/login-footer.vue")
            );

            $view2 = view('frontend::Argon/template/src/components/layouts/loginheaderVue');

            $stub2 = new StubGenerator(
                $this->context,
                $view2->render(),
                resource_path("frontend/src/components/layouts/login-header.vue")
            );

            $view3 = view('frontend::Argon/template/src/components/layouts/loginlayoutVue');

            $stub3 = new StubGenerator(
                $this->context,
                $view3->render(),
                resource_path("frontend/src/components/layouts/login-layout.vue")
            );

            $view4 = view('frontend::Argon/template/src/components/layouts/logintopnavVue');

            $stub4 = new StubGenerator(
                $this->context,
                $view4->render(),
                resource_path("frontend/src/components/layouts/login-top-nav.vue")
            );

            $view5 = view('frontend::Argon/template/src/components/layouts/mainfooterVue');

            $stub5 = new StubGenerator(
                $this->context,
                $view5->render(),
                resource_path("frontend/src/components/layouts/main-footer.vue")
            );

            // $view6 = view('frontend::Argon/template/src/components/layouts/mainheaderVue');

            // $stub6 = new StubGenerator(
            //     $this->context,
            //     $view6->render(),
            //     resource_path("frontend/src/components/layouts/main-header.vue")
            // );

            $view7 = view('frontend::Argon/template/src/components/layouts/mainlayoutVue');

            $stub7 = new StubGenerator(
                $this->context,
                $view7->render(),
                resource_path("frontend/src/components/layouts/main-layout.vue")
            );

            // $view8 = view('frontend::Argon/template/src/components/layouts/sidebarVue');

            // $stub8 = new StubGenerator(
            //     $this->context,
            //     $view8->render(),
            //     resource_path("frontend/src/components/layouts/sidebar.vue")
            // );

            $view9 = view('frontend::Argon/template/src/components/layouts/topnavVue');

            $stub9 = new StubGenerator(
                $this->context,
                $view9->render(),
                resource_path("frontend/src/components/layouts/top-nav.vue")
            );

            $stub->render();
            $stub2->render();
            $stub3->render();
            $stub4->render();
            $stub5->render();
            // $stub6->render();
            $stub7->render();
            // $stub8->render();
            $stub9->render();
            $this->context->info("Layouts file Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
