<?php

namespace Rekamy\Generator\Console\Commands;

use Illuminate\Console\Command;
use Rekamy\Generator\Core\BuildConfig;
use Symfony\Component\Console\Helper\Table;
use Rekamy\Generator\Core\Generators\MigrationGenerator as TemplateGenerator;


class MigrationGenerator extends Command
{
    use BuildConfig;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Migration from existing database';

    public $context;
    public $progressbar;

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
            'migration' => TemplateGenerator::class,
        ];

        foreach ($generators as $class) {
            $generator = new $class($this);
            $generator->generate();
            $this->newline();
        }
    }
}
