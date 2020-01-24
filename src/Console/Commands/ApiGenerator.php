<?php

namespace Rekamy\ApiGenerator\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Rekamy\ApiGenerator\Console\Context;
use Symfony\Component\Console\Helper\Table;

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

    public $context;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Context $context)
    {
        parent::__construct();
        $this->context = $context;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $table = new Table($this->output);
        if ($this->context->generate['models'])
            $this->context->generateModels($table);

        $table->render();

        if ($this->context->generate['controllers'])
            $this->context->generateControllers($table);

        $table->render();

        if ($this->context->generate['base_controller'])
            $this->context->generateBaseController($table);

        $table->render();

        if ($this->context->generate['app_base_controller'])
            $this->context->generateAppBaseController($table);

        $table->render();

        if ($this->context->generate['repositories'])
            $this->context->generateRepositories($table);

        $table->render();

        if ($this->context->generate['requests'])
            $this->context->generateRequests($table);

        $table->render();

        if ($this->context->generate['routes'])
            $this->context->generateRoutes($table);

        $table->render();
    }
}
