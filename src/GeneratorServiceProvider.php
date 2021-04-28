<?php

namespace Rekamy\Generator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Rekamy\Generator\Console\Commands\{
    FrontendCrudGenerator,
    InitGenerator,
    BackendCrudGenerator,
    MigrationGenerator
};

class GeneratorServiceProvider extends ServiceProvider
{
    protected $commands = [
        InitGenerator::class,
        BackendCrudGenerator::class,
        FrontendCrudGenerator::class,
        MigrationGenerator::class,
    ];

    public function boot()
    {
        // Builder::macro('whereLike', function (string $attribute, string $searchTerm) {
        //     return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        // });

        \Str::macro('absoluteTitle', function (string $value) {
            return \Str::of($value)->kebab()->replace('_', ' ')->title();
        });

        Stringable::macro('absoluteTitle', function () {
            $string = (string) \Str::of($this->value)->kebab()->replace('_', ' ')->title();
            return new Stringable($string);
        });

        $this->publishes([
            __DIR__ . '/config/rekamygenerator.php' => config_path('rekamygenerator.php'),
        ], 'rekamygenerator');

        // $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/templates/api', 'api');
        $this->loadViewsFrom(__DIR__ . '/templates/web', 'webtemplate');
        $this->loadViewsFrom(__DIR__ . '/templates/backend', 'backend');
        $this->loadViewsFrom(__DIR__ . '/templates/frontend', 'frontend');
        $this->loadViewsFrom(__DIR__ . '/templates/swagger', 'swagger');
        $this->loadViewsFrom(__DIR__ . '/templates/migration', 'migration');
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
