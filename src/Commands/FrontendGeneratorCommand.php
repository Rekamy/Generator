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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->loadConfig();
        // $this->template = $this->choice('Choose your template ?', ['Argon', 'Sparker', 'Robust'], $this->defaultIndex);
        $this->initFrontend();    
        $this->generateFiles($this->config->generators->frontend);
        $path = $this->config->setup->frontend->path->root;
        shell_exec("cd {$path} && npx prettier --write **/*.vue");
    }

    public function initFrontend() {
        $path = $this->config->setup->frontend->path->root;
        $source = $this->config->setup->frontend->source;
        if(file_exists($path)) return;

        shell_exec("git clone {$source} {$path} && rm -rf {$path}/.git");
        shell_exec("cd {$path} && npm i");
    }
}
