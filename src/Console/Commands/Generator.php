<?php

namespace Rekamy\Generator\Console\Commands;

use Illuminate\Console\Command;
use Rekamy\Generator\Core\Context;
use Rekamy\Generator\Core\BuildConfig;
use Symfony\Component\Console\Helper\Table;

use Rekamy\Generator\Core\Generators\BaseControllerGenerator;
use Rekamy\Generator\Core\Generators\ModelGenerator;
use Rekamy\Generator\Core\Generators\BlocGenerator;
use Rekamy\Generator\Core\Generators\RepositoryGenerator;
use Rekamy\Generator\Core\Generators\CrudableTraitGenerator;
use Rekamy\Generator\Core\Generators\HasRepositoryGenerator;
use Rekamy\Generator\Core\Generators\HasRequestGenerator;
use Rekamy\Generator\Core\Generators\CrudBlocGenerator;
use Rekamy\Generator\Core\Generators\CrudBlocInterfaceGenerator;
use Rekamy\Generator\Core\Generators\CrudControllerGenerator;
use Rekamy\Generator\Core\Generators\CrudRepositoryInterfaceGenerator;
use Rekamy\Generator\Core\Generators\RequestInterfaceGenerator;


class Generator extends Command
{
    use BuildConfig;
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
    public $progressbar;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->loadConfig();
        $this->apiGenerator();

    }

    public function apiGenerator()
    {
        $generators = [
            'model' => ModelGenerator::class,
            'bloc' => BlocGenerator::class,
            'repository' => RepositoryGenerator::class,
            'base_controller' => BaseControllerGenerator::class,
            'crudable_trait' => CrudableTraitGenerator::class,
            'has_repository_trait' => HasRepositoryGenerator::class,
            'has_request_trait' => HasRequestGenerator::class,
            'crud_bloc' => CrudBlocGenerator::class,
            'crud_bloc_Interface' => CrudBlocInterfaceGenerator::class,
            'crud_controller' => CrudControllerGenerator::class,
            'crud_repository_interface' => CrudRepositoryInterfaceGenerator::class,
            'request_interface' => RequestInterfaceGenerator::class,
        ];

        foreach ($generators as $class) {
            $generator = new $class($this);
            $generator->generate();
            $this->newline();
        }
    }
    // public function apiGenerator()
    // {
    //     $table = new Table($this->output);
    //     if ($this->context->generate['models'])
    //         $this->context->generateModels($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['api_controllers'])
    //         $this->context->generateApiControllers($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['base_controller'])
    //         $this->context->generateBaseController($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['app_base_controller'])
    //         $this->context->generateAppBaseController($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['repositories'])
    //         $this->context->generateRepositories($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['api_requests'])
    //         $this->context->generateApiRequests($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['api_routes'])
    //         $this->context->generateApiRoutes($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['swagger_api_doc'])
    //         $this->context->generateSwaggerApiDoc($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();
    // }


    // public function webGenerator()
    // {
    //     $choice = $this->choice('Which template would you want to generate?', ['Robust', 'AdminLTE', 'CoreUI']);

    //     $table = new Table($this->output);
    //     if ($this->context->generate['models'])
    //         $this->context->generateModels($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['web_controllers'])
    //         $this->context->generateWebControllers($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['base_controller'])
    //         $this->context->generateBaseController($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['app_base_controller'])
    //         $this->context->generateAppBaseController($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['repositories'])
    //         $this->context->generateRepositories($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['web_requests'])
    //         $this->context->generateWebRequests($table);

    //     echo PHP_EOL;
    //     $table->render();
    //     if ($this->context->progress) $this->context->progress->finish();

    //     if ($this->context->generate['web_routes'])
    //         $this->context->generateWebRoutes($table);

    //     echo PHP_EOL;
    //     $table->render();

    //     if ($choice == "Robust") {
    //         if ($this->context->generate['module_views'])
    //             $this->context->generateRobustModuleViews($table);

    //         echo PHP_EOL;
    //         $table->render();

    //         if ($this->context->template['vendor_files']) {
    //             $publishTemplateAsset = $this->confirm('Are you sure to republish template file?');
    //             if ($publishTemplateAsset)
    //                 $this->context->countRobustPublicFiles();
    //         }
    //     } else if ($choice == "AdminLTE") {
    //         if ($this->context->generate['module_views'])
    //             $this->context->generateRobustModuleViews($table);

    //         echo PHP_EOL;
    //         $table->render();

    //         $this->context->countRobustPublicFiles();
    //     } else if ($choice == "CoreUI") {
    //         if ($this->context->generate['module_views'])
    //             $this->context->generateRobustModuleViews($table);

    //         echo PHP_EOL;
    //         $table->render();

    //         $this->context->countRobustPublicFiles();
    //     }

    //     if ($this->context->progress) $this->context->progress->finish();
    // }
}
