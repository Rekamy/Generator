<?php

namespace Rekamy\Generator\Commands;

use Illuminate\Console\Command;
use Rekamy\Generator\Core\BuildConfig;

class InitGeneratorCommand extends Command
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
    protected $description = 'Generate boilerplate for the whole project';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->loadConfig();
        $commands = collect();
        $frontendPath = $this->config->setup->frontend->path->root;

        if ($this->confirm('Generate migration from current database?', false)) {
            $commands->push(['artisan' => 'generate:migration']);
        } else {
            $hasLaravelPermission = \Composer\InstalledVersions::isInstalled('spatie/laravel-permission');
            if ($hasLaravelPermission && $this->confirm('Publish spatie/laravel-permission?', true)) {
                $commands->push(['shell' => 'php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"']);
            }

            if ($this->confirm('Run fresh migration?', false)) {
                $commands->push(['artisan' => 'migrate:fresh']);
            }
        }

        if ($this->confirm('Generate backend from current database?', true)) {
            $commands->push(['artisan' => 'generate:backend']);
            $commands->push(['artisan' => 'passport:install']);
        }

        if ($this->confirm('Generate frontend from current database?', true)) {
            $commands->push(['artisan' => 'generate:frontend']);
            if ($this->confirm('Build application on complete generation?', false))
                $commands->push(['shell' => "cd {$frontendPath} && npm run build"]);
        }

        $commands->each(function ($command) {
            if (!empty($command['artisan'])) {
                $this->call($command['artisan']);
            } else {
                shell_exec($command['shell']);
            }
        });
    }
}
