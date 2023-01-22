<?php

namespace Rekamy\Generator\Commands;

use Illuminate\Console\Command;
use Rekamy\Generator\Core\BuildConfig;
use Rekamy\Generator\Core\Generators\Backend\{
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
    APIRoutesGenerator,
    DatatableCriteriaContractsGenerator,
    LengthAwarePaginatorContractsGenerator,
    ServiceProvidersGenerator,
    RequestExtensionContractsGenerator,
    BaseRepositoryContractsGenerator,
    RequestCriteriaContractsGenerator,
    FileUploadContractsGenerator,
    HasAuditorRelationGenerator,
    DependenciesSetupGenerator,
};


class BackendGeneratorCommand extends Command
{
    use BuildConfig;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:backend';

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
        $this->generateFiles($this->config->generators->backend);
    }

}
