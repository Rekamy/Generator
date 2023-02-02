<?php

namespace Rekamy\Generator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Stringable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Rekamy\Generator\Commands\{
    FrontendGeneratorCommand,
    InitGeneratorCommand,
    BackendGeneratorCommand,
    MigrationGeneratorCommand
};
use Symfony\Component\Yaml\Yaml;

class GeneratorServiceProvider extends ServiceProvider
{
    protected $commands = [
        InitGeneratorCommand::class,
        BackendGeneratorCommand::class,
        FrontendGeneratorCommand::class,
        MigrationGeneratorCommand::class,
    ];

    public function boot()
    {
        $ob = DB::usingConnection('test', function ($var = null)
        {
            # code...
        });

        dd($ob);
        $array = [
            'tables' => [
                'user' => [
                    'id' => Schema::class,
                    'username' => ['Role', '\\App\\Models\\Permissions'],
                    'email' => 'string',
                    'password' => 'string',
                    'username' => ['Role', 'App\Models\Permissions'],
                ],
            ],
            'models' => [
                'user' => [
                    'hasOne' => Str::class,
                    'hasMany' => ['Role', '\\App\\Models\\Permissions'],
                    'belongsTo' => 'Department',
                    'belongsToMany' => \Spatie\LaravelPermission\Models\Role::class,
                ],
            ],
        ];

        $this->write($array);

        // Builder::macro('whereLike', function (string $attribute, string $searchTerm) {
        //     return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        // });

        // Str::macro('headline()', function (string $value) {
        //     return Str::of($value)->kebab()->replace('_', ' ')->title();
        // });

        // Stringable::macro('headline()', function () {
        //     $string = (string) Str::of($this->value)->kebab()->replace('_', ' ')->title();
        //     return new Stringable($string);
        // });

        $this->publishes([
            __DIR__ . '/../config/rekamygenerator.php' => config_path('rekamygenerator.php'),
        ], 'rekamygenerator');

        // $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // $this->loadViewsFrom(__DIR__ . '/templates/api', 'api');
        // $this->loadViewsFrom(__DIR__ . '/templates/web', 'webtemplate');
        $this->loadViewsFrom(__DIR__ . '/templates/backend', 'backend');
        $this->loadViewsFrom(__DIR__ . '/templates/frontend', 'frontend');
        $this->loadViewsFrom(__DIR__ . '/templates/swagger', 'swagger');
        $this->loadViewsFrom(__DIR__ . '/templates/migration', 'migration');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/rekamygenerator.php',
            'rekamygenerator'
        );

        $this->commands($this->commands);
    }

    public function dump(array $generated)
    {
        return Yaml::dump($generated);
    }

    public function parse(string $generated)
    {
        return Yaml::parse($generated);
    }

    public function write(mixed $generated): void
    {
        file_put_contents(__DIR__ . '/../schema.yaml', $this->dump($generated, 5));
    }
}
