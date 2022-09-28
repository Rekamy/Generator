<?php

namespace Rekamy\Generator\Commands;

use Illuminate\Console\Command;
use Rekamy\Generator\Core\BuildConfig;
use Rekamy\Generator\Core\Generators\Frontend\{
    BaseTSGenerator,
    BaseVueGenerator,
    VueRouteGenerator,
    CrudBaseTSGenerator,
    CrudBaseVueGenerator,
    CrudFormComponentVueGenerator,
    CrudManageVueGenerator,
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
    WebRoutesRelayGenerator,
};


class FrontendGeneratorCommand extends Command
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
    private $defaultIndex = 0;


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
        // $this->template = $this->choice('Choose your template ?', ['Argon', 'Sparker', 'Robust'], $this->defaultIndex);

        // $this->generate();

        $this->generateModule();
    }

    public function generate()
    {
        $generators = [
            'base' => DashboardGenerator::class,

            'web_route' => WebRoutesRelayGenerator::class,
            'route' => VueRouteGenerator::class,

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

        foreach ($generators as $key => $class) {
            $skip = false;
            $classOverride = null;

            if (!empty($this->generate['frontend'][$key]['skip']))
                $skip = $this->generate['frontend'][$key]['skip'];

            if ($skip) continue;

            if (!empty($this->generate['frontend'][$key]['class']))
                $classOverride = $this->generate['frontend'][$key]['class'];

            $generator = $classOverride ? new $classOverride($this) : new $class($this);
            $generator->generate();
            $this->newline();
        }
    }

    public function generateModule()
    {
        $generators = [
            'base' => DashboardGenerator::class,
            'route' => VueRouteGenerator::class,
            'frontendModule' => FrontendModuleGenerator::class,

            'crudManageVue' => CrudManageVueGenerator::class,
            'crudCreateVue' => CrudCreateVueGenerator::class,
            'crudViewVue' => CrudViewVueGenerator::class,
            'crudEditVue' => CrudEditVueGenerator::class,
            'crudFormComponentVue' => CrudFormComponentVueGenerator::class,
        ];

        foreach ($generators as $key => $class) {
            $skip = false;
            $classOverride = null;

            if (!empty($this->generate['frontend'][$key]['skip']))
                $skip = $this->generate['frontend'][$key]['skip'];

            if ($skip) continue;

            if (!empty($this->generate['frontend'][$key]['class']))
                $classOverride = $this->generate['frontend'][$key]['class'];

            $generator = $classOverride ? new $classOverride($this) : new $class($this);
            $generator->generate();
            $this->newline();
        }
    }
}
