<?php

namespace Rekamy\Generator\Console\Commands;

use Illuminate\Console\Command;
use Rekamy\Generator\Core\BuildConfig;
use Symfony\Component\Console\Helper\Table;
use Rekamy\Generator\Core\Generators\{
    BaseTSGenerator,
    BaseVueGenerator,
    VueRouteGenerator,
    CrudBaseTSGenerator,
    CrudBaseVueGenerator,
    CrudIndexTSGenerator,
    CrudIndexVueGenerator,
    CrudViewTSGenerator,
    CrudViewVueGenerator,
    CrudCreateTSGenerator,
    CrudCreateVueGenerator,
    CrudEditTSGenerator,
    CrudEditVueGenerator,
    DashboardGenerator,
    FrontendModuleGenerator,
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
            // 'baseVue' => BaseVueGenerator::class,
            // 'baseTs' => BaseTSGenerator::class,

            'dashboard' => DashboardGenerator::class,

            'route' => VueRouteGenerator::class,

            'crudBaseVue' => CrudBaseVueGenerator::class,
            'crudBaseTS' => CrudBaseTSGenerator::class,

            'crudIndexVue' => CrudIndexVueGenerator::class,
            'crudIndexTS' => CrudIndexTSGenerator::class,

            'crudCreateVue' => CrudCreateVueGenerator::class,
            'crudCreateTS' => CrudCreateTSGenerator::class,

            'crudViewVue' => CrudViewVueGenerator::class,
            'crudViewTS' => CrudViewTSGenerator::class,

            'crudEditVue' => CrudEditVueGenerator::class,
            'crudEditTS' => CrudEditTSGenerator::class,

            'frontendModule' => FrontendModuleGenerator::class,
        ];

        foreach ($generators as $class) {
            $generator = new $class($this);
            $generator->generate();
            $this->newline();
        }
    }
}
