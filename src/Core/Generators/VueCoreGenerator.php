<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class VueCoreGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Config file...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            $this->context->info("Components file Created.");
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/core/components/datatable/assetsTs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/core/components/datatable/assets.ts")
            );

            $view2 = view('frontend::Argon/template/src/core/components/datatable/builderTs');

            $stub2 = new StubGenerator(
                $this->context,
                $view2->render(),
                resource_path("frontend/src/core/components/datatable/builder.ts")
            );

            $view3 = view('frontend::Argon/template/src/core/components/datatable/contractTs');

            $stub3 = new StubGenerator(
                $this->context,
                $view3->render(),
                resource_path("frontend/src/core/components/datatable/contract.ts")
            );

            $view4 = view('frontend::Argon/template/src/core/components/datatable/indexTs');

            $stub4 = new StubGenerator(
                $this->context,
                $view4->render(),
                resource_path("frontend/src/core/components/datatable/index.ts")
            );

            $view5 = view('frontend::Argon/template/src/core/components/datatable/propsTs');

            $stub5 = new StubGenerator(
                $this->context,
                $view5->render(),
                resource_path("frontend/src/core/components/datatable/props.ts")
            );

            $view6 = view('frontend::Argon/template/src/core/components/datatable/templateVue');

            $stub6 = new StubGenerator(
                $this->context,
                $view6->render(),
                resource_path("frontend/src/core/components/datatable/template.vue")
            );

            $stub->render();
            $stub2->render();
            $stub3->render();
            $stub4->render();
            $stub5->render();
            $stub6->render();
            $this->context->info("Datatable file Created.");
            $this->generateSelect();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateSelect()
    {
        try {
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/core/components/select2/builderTs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/core/components/select2/builder.ts")
            );

            $view2 = view('frontend::Argon/template/src/core/components/select2/indexTs');

            $stub2 = new StubGenerator(
                $this->context,
                $view2->render(),
                resource_path("frontend/src/core/components/select2/index.ts")
            );

            $view3 = view('frontend::Argon/template/src/core/components/select2/templateVue');

            $stub3 = new StubGenerator(
                $this->context,
                $view3->render(),
                resource_path("frontend/src/core/components/select2/template.vue")
            );

            $stub->render();
            $stub2->render();
            $stub3->render();
            $this->context->info("Select2 file Created.");
            $this->generatePlugins();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generatePlugins()
    {
        try {
            $this->context->info("Plugins file Created.");
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/core/plugins/indexTs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/core/plugins/index.ts")
            );

            $view2 = view('frontend::Argon/template/src/core/plugins/datatable/indexTs');

            $stub2 = new StubGenerator(
                $this->context,
                $view2->render(),
                resource_path("frontend/src/core/plugins/datatable/index.ts")
            );

            $view3 = view('frontend::Argon/template/src/core/plugins/select2/indexTs');

            $stub3 = new StubGenerator(
                $this->context,
                $view3->render(),
                resource_path("frontend/src/core/plugins/select2/index.ts")
            );

            $stub->render();
            $stub2->render();
            $stub3->render();

            $this->context->info("Datatable file Created.");
            $this->context->info("Select2 file Created.");
            $this->generateServices();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateServices()
    {
        try {
            $this->context->info("Services file Created.");
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/core/services/api/apiserviceTs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/core/services/api/api.service.ts")
            );

            $view2 = view('frontend::Argon/template/src/core/services/api/indexTs');

            $stub2 = new StubGenerator(
                $this->context,
                $view2->render(),
                resource_path("frontend/src/core/services/api/index.ts")
            );

            $view3 = view('frontend::Argon/template/src/core/services/store/indexTs');

            $stub3 = new StubGenerator(
                $this->context,
                $view3->render(),
                resource_path("frontend/src/core/services/store/index.ts")
            );

            $stub->render();
            $stub2->render();
            $stub3->render();
            $this->context->info("Api file Created.");
            $this->context->info("Store file Created.");
            $this->generateUtils();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateUtils()
    {
        try {
            $this->context->info("Utils file Created.");
            $data['routes'] = [];
            foreach ($this->tables as $key => $table) {
                $data['routes'][] = Str::of($table)->singular();
            }

            $view = view('frontend::Argon/template/src/core/utils/helperTs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/src/core/utils/helper.ts")
            );

            
            $view2 = view('frontend::Argon/template/src/core/utils/indexTs');

            $stub2 = new StubGenerator(
                $this->context,
                $view2->render(),
                resource_path("frontend/src/core/utils/index.ts")
            );

            $view3 = view('frontend::Argon/template/src/core/utils/mainTs');

            $stub3 = new StubGenerator(
                $this->context,
                $view3->render(),
                resource_path("frontend/src/core/utils/main.ts")
            );

            $view4 = view('frontend::Argon/template/src/core/utils/storageTs');

            $stub4 = new StubGenerator(
                $this->context,
                $view4->render(),
                resource_path("frontend/src/core/utils/storage.ts")
            );

            $view5 = view('frontend::Argon/template/src/core/utils/validatorTs');

            $stub5 = new StubGenerator(
                $this->context,
                $view5->render(),
                resource_path("frontend/src/core/utils/validator.ts")
            );

            $view6 = view('frontend::Argon/template/src/core/utils/widgetTs');

            $stub6 = new StubGenerator(
                $this->context,
                $view6->render(),
                resource_path("frontend/src/core/utils/widget.ts")
            );

            $stub->render();
            $stub2->render();
            $stub3->render();
            $stub4->render();
            $stub5->render();
            $stub6->render();
            $this->context->info("Api file Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
