<?php

namespace Rekamy\Generator\Console\Commands;

use Illuminate\Console\Command;
use Rekamy\Generator\Core\BuildConfig;
use Symfony\Component\Console\Helper\Table;
use Rekamy\Generator\Core\Generators\{
    BaseControllerGenerator,
    BaseTSGenerator,
    BaseVueGenerator,
    VueRouteGenerator,
    ModelGenerator,
    BlocGenerator,
    RepositoryGenerator,
    ControllerGenerator,
    RequestGenerator,
    CrudableTraitGenerator,
    HasRepositoryGenerator,
    HasRequestGenerator,
    CrudBlocGenerator,
    CrudBlocInterfaceGenerator,
    CrudControllerGenerator,
    CrudRepositoryInterfaceGenerator,
    CrudRequestInterfaceGenerator,
};


class FrontendCrudGenerator extends Command
{
    use BuildConfig;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:frontend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Frontend CRUD API';

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
        $this->generate();
    }

    public function generate()
    {
        $generators = [
            'baseVue' => BaseVueGenerator::class,
            'baseTs' => BaseTSGenerator::class,
            'route' => VueRouteGenerator::class,
        ];

        foreach ($generators as $class) {
            $generator = new $class($this);
            $generator->generate();
            $this->newline();
        }
    }
}
