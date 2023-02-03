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

        // $ob = DB::getDoctrineColumn('addresses', 'address');
        $ob = DB::getDoctrineSchemaManager()->listTables();

        // listTableNames
        // listTableColumns

        $object = [
            'tables' => [
                'user' => [
                    'id' => 'id',
                    'username' => 'string:select',
                    'email' => 'string',
                    'password' => 'string',
                    'username' => 'string',
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

        // $this->writeYaml($object);

        dd(file_get_contents(__DIR__ . '/../config/rekamygenerator.php'));
        
        dd($this->readFile('/Core/Factory.php'));

        dd($this->readYaml('/../schema.yaml'));
        dd(file(__DIR__ . '/../schema.yaml'));
        dd($this->writeYaml(file(__DIR__ . '/Core/Factory.php')));
        dd($this->writeYaml(config('rekamygenerator')));
        // dd(collect($object)->first());
        // dd($this->writeYaml($object)->dump($object));

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

    public function yaml(): Yaml
    {
        return app(Yaml::class);
    }

    /**
     * Dumps a PHP value to a YAML string.
     *
     * The dump method, when supplied with an array, will do its best
     * to convert the array into friendly YAML.
     *
     * @param mixed $input  The PHP value
     * @param int   $inline The level where you switch to inline YAML
     * @param int   $indent The amount of spaces to use for indentation of nested nodes
     * @param int   $flags  A bit field of DUMP_* constants to customize the dumped YAML string
     */
    public function dump(array $object)
    {
        return $this->yaml()->dump($object, 5, 2, Yaml::DUMP_EMPTY_ARRAY_AS_SEQUENCE);
    }

    /**
     * Parses YAML into a PHP value.
     *
     *  Usage:
     *  <code>
     *   $array = Yaml::parse(file_get_contents('config.yml'));
     *   print_r($array);
     *  </code>
     *
     * @param string $input A string containing YAML
     * @param int    $flags A bit field of PARSE_* constants to customize the YAML parser behavior
     *
     * @throws ParseException If the YAML is not valid
     */
    public function parse(string $literal, int $flags = 0)
    {
        return $this->yaml()->parse($literal, $flags);
    }

    /**
     * Reads any file returning a string.
     *
     * Usage:
     *
     *     $array = Yaml::parseFile('config.yml');
     *     print_r($array);
     *
     * @param string $filename The path to the file to be parsed
     * @param bool    $asArray Returns multiline strings as PHP value
     * @return mixed
     */
    public function readFile(string $filename, bool $asArray = false)
    {
        if ($asArray)
            return file(__DIR__ . $filename);

        return file_get_contents(__DIR__ . $filename);
    }

    /**
     * Reads a YAML file returning PHP values.
     *
     * Usage:
     *
     *     $array = Yaml::parseFile('config.yml');
     *     print_r($array);
     *
     * @param string $filename The path to the YAML file to be parsed
     * @param int    $flags    A bit field of PARSE_* constants to customize the YAML parser behavior
     *
     * @throws ParseException If the file could not be read or the YAML is not valid
     */
    public function readYaml(string $filename, int $flags = 0)
    {
        return $this->yaml()->parseFile(__DIR__ . $filename, $flags);
    }

    /**
     * Write parsed PHP values into a YAML file.
     *
     * The dump method, when supplied with an array, will do its best
     * to convert the array into friendly YAML.
     *
     * @param mixed $input  The PHP value
     * @param int   $inline The level where you switch to inline YAML
     * @param int   $indent The amount of spaces to use for indentation of nested nodes
     * @param int   $flags  A bit field of DUMP_* constants to customize the dumped YAML string
     */
    public function writeYaml(mixed $object = [])
    {
        file_put_contents(__DIR__ . '/../schema.yaml', $this->dump($object));

        return $this;
    }
}
