<?php

namespace Rekamy\Generator\Commands;

use Illuminate\Console\Command;
use Rekamy\Generator\Core\BuildConfig;
use Rekamy\Generator\Core\Generators\MigrationGenerator;


class MigrationGeneratorCommand extends Command
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
        $generator = new MigrationGenerator($this);
        $generator->generate();
        $this->newline();
    }
}
