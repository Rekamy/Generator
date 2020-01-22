<?php

namespace Rekamy\ApiGenerator;

use Illuminate\Support\ServiceProvider;

class ApiGeneratorServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Rekamy\ApiGenerator\Console\Commands\ApiGenerator',
    ];

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->publishes([
            __DIR__ . '/config/apigenerator.php' => config_path('apigenerator.php')
        ]);
    }

    public function register()
    {
        $this->commands($this->commands);
    }
}
