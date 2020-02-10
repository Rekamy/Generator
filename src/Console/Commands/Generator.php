<?php

namespace Rekamy\Generator\Console\Commands;

use Illuminate\Console\Command;
use Rekamy\Generator\Console\Context;
use Symfony\Component\Console\Helper\Table;

class Generator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate CRUD API';

    public $context;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Context $context)
    {
        parent::__construct();
        $this->context = $context;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->context->outputDecorator = $this->output;
        $choice = $this->choice('Which CRUD would you want to generate?', ['Web', 'Api']);

        if ($choice == "Web") {
            $this->webGenerator();
        } else if ($choice == "Api") {
            $this->apiGenerator();
        }
    }

    public function apiGenerator()
    {
        $table = new Table($this->output);
        if ($this->context->generate['models'])
            $this->context->generateModels($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['api_controllers'])
            $this->context->generateApiControllers($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['base_controller'])
            $this->context->generateBaseController($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['app_base_controller'])
            $this->context->generateAppBaseController($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['repositories'])
            $this->context->generateRepositories($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['api_requests'])
            $this->context->generateApiRequests($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['api_routes'])
            $this->context->generateApiRoutes($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['swagger_api_doc'])
            $this->context->generateSwaggerApiDoc($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();
    }


    public function webGenerator()
    {
        $choice = $this->choice('Which template would you want to generate?', ['Robust', 'AdminLTE', 'CoreUI']);

        $table = new Table($this->output);
        if ($this->context->generate['models'])
            $this->context->generateModels($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['web_controllers'])
            $this->context->generateWebControllers($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['base_controller'])
            $this->context->generateBaseController($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['app_base_controller'])
            $this->context->generateAppBaseController($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['repositories'])
            $this->context->generateRepositories($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['web_requests'])
            $this->context->generateWebRequests($table);

        echo PHP_EOL;
        $table->render();
        $this->context->progress->finish();

        if ($this->context->generate['web_routes'])
            $this->context->generateWebRoutes($table);

        echo PHP_EOL;
        $table->render();

        if ($choice == "Robust") {
            if ($this->context->generate['module_views'])
                $this->context->generateRobustModuleViews($table);

            echo PHP_EOL;
            $table->render();

            if($this->context->template['vendor_files'])
            $this->context->countRobustPublicFiles();
        } else if ($choice == "AdminLTE") {
            if ($this->context->generate['module_views'])
                $this->context->generateRobustModuleViews($table);

            echo PHP_EOL;
            $table->render();

            $this->context->countRobustPublicFiles();
        } else if ($choice == "CoreUI") {
            if ($this->context->generate['module_views'])
                $this->context->generateRobustModuleViews($table);

            echo PHP_EOL;
            $table->render();

            $this->context->countRobustPublicFiles();
        }

        $this->context->progress->finish();
    }
}
