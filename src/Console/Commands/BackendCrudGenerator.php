<?php

namespace Rekamy\Generator\Console\Commands;

use Illuminate\Console\Command;
use Rekamy\Generator\Core\BuildConfig;
use Symfony\Component\Console\Helper\Table;
use Rekamy\Generator\Core\Generators\{
    APIDocGenerator,
    APIDocInfoGenerator,
    AuthControllerGenerator,
    BaseControllerGenerator,
    ModelGenerator,
    BlocGenerator,
    RepositoryGenerator,
    ControllerGenerator,
    RequestGenerator,
    CrudableTraitGenerator,
    CrudableRepositoryTraitGenerator,
    HasRepositoryGenerator,
    HasRequestGenerator,
    CrudBlocGenerator,
    CrudBlocInterfaceGenerator,
    CrudControllerGenerator,
    CrudRepositoryInterfaceGenerator,
    CrudRequestInterfaceGenerator,
    ExceptionValidationGenerator,
    APIRoutesGenerator
};


class BackendCrudGenerator extends Command
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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->loadConfig();
        $this->generate();
    }

    public function generate()
    {
        $generators = [
            'model' => ModelGenerator::class,
            'bloc' => BlocGenerator::class,
            'repository' => RepositoryGenerator::class,
            'controller' => ControllerGenerator::class,
            'request' => RequestGenerator::class,
            'exception_validation' => ExceptionValidationGenerator::class,

            // TODO: Crud Route Service Provider 
            'apiDoc' => APIDocGenerator::class,
            'apiDocInfo' => APIDocInfoGenerator::class,

            // traits
            'crudable_trait' => CrudableTraitGenerator::class,
            'crudable_repository_trait' => CrudableRepositoryTraitGenerator::class,
            'has_repository_trait' => HasRepositoryGenerator::class,
            'has_request_trait' => HasRequestGenerator::class,

            //auth
            'auth_controller' => AuthControllerGenerator::class,

            // base
            'base_controller' => BaseControllerGenerator::class,
            'crud_bloc' => CrudBlocGenerator::class,
            'crud_controller' => CrudControllerGenerator::class,

            // contracts
            'crud_repository_interface' => CrudRepositoryInterfaceGenerator::class,
            'crud_bloc_Interface' => CrudBlocInterfaceGenerator::class,
            'request_interface' => CrudRequestInterfaceGenerator::class,

            //Api route
            'routes_api' => APIRoutesGenerator::class,

        ];

        foreach ($generators as $class) {
            $generator = new $class($this);
            $generator->generate();
            $this->newline();
        }
    }
}
