<?php

namespace Rekamy\ApiGenerator\Console\Commands;

use Illuminate\Console\Command;
use Rekamy\ApiGenerator\Console\RuleParser;
use Rekamy\ApiGenerator\Console\StubGenerator;
use Illuminate\Support\Str;
use DB;

class ApiGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate CRUD API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo 'this is artisan command';
    }
}
