<?php

namespace Rekamy\Generator;

use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Rekamy\Generator\Console\Commands\Generator'
    ];

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views/GeneratorTemplates/api', 'apitemplate');
        $this->loadViewsFrom(__DIR__ . '/resources/views/GeneratorTemplates/web', 'webtemplate');
        $this->loadViewsFrom(__DIR__ . '/resources/views/GeneratorTemplates/general', 'generaltemplate');
        $this->loadViewsFrom(__DIR__ . '/resources/views/GeneratorTemplates/web/robust-theme-template', 'robust');
        $this->loadViewsFrom(__DIR__ . '/resources/views/GeneratorTemplates/web/robust-theme-template/js', 'robustjs');
        $this->loadViewsFrom(__DIR__ . '/resources/views/GeneratorTemplates/web/robust-theme-template/layouts', 'robustlayouts');
        $this->publishes([
            __DIR__ . '/config/rekamygenerator.php' => config_path('rekamygenerator.php')
        ]);
    }

    public function register()
    {
        $this->commands($this->commands);
    }
}