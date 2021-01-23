<?php

namespace Rekamy\Generator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Rekamy\Generator\Console\Commands\{
    FrontendCrudGenerator,
    BackendCrudGenerator,
    MigrationGenerator
};

class GeneratorServiceProvider extends ServiceProvider
{
    protected $commands = [
        BackendCrudGenerator::class,
        FrontendCrudGenerator::class,
        MigrationGenerator::class,
    ];

    public function boot()
    {
        Builder::macro('whereLike', function (string $attribute, string $searchTerm) {
            return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        });

        $this->publishes([
            __DIR__ . '/config/rekamygenerator.php' => config_path('rekamygenerator.php'),
        ], 'rekamygenerator');

        // $this->loadRoutesFrom(__DIR__ . '/routes/web.php');


        $this->loadViewsFrom(__DIR__ . '/templates/api', 'apitemplate');
        $this->loadViewsFrom(__DIR__ . '/templates/web', 'webtemplate');
        $this->loadViewsFrom(__DIR__ . '/templates/backend', 'backend');
        $this->loadViewsFrom(__DIR__ . '/templates/frontend', 'frontend');
        $this->loadViewsFrom(__DIR__ . '/templates/swagger', 'swagger');
        $this->loadViewsFrom(__DIR__ . '/templates/migration', 'migration');
        // $this->loadViewsFrom(__DIR__ . '/templates/web/robust-theme-template', 'robust');
        // $this->loadViewsFrom(__DIR__ . '/templates/web/robust-theme-template/js', 'robustjs');
        // $this->loadViewsFrom(__DIR__ . '/templates/web/robust-theme-template/layouts', 'robustlayouts');
        
    }

    public function register()
    {
        // TODO: laravel bugs : mergeConfigFrom
        // $this->mergeConfigFrom(
        //     __DIR__ . '/config/rekamygenerator.php', 'rekamygenerator'
        // );
        $config = $this->app['config']->get('rekamygenerator', []);
        $this->app['config']->set('rekamygenerator', array_merge(require __DIR__ . '/config/rekamygenerator.php', $config));

        $this->commands($this->commands);
    }
}
