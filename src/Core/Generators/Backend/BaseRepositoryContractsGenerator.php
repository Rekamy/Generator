<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use Rekamy\Generator\Core\StubGenerator;

class BaseRepositoryContractsGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Base Repository Contracts...");
    }

    public function generate()
    {
        try {
            $view = view('backend::override.BaseRepository')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->config->setup->backend->override->path . 'BaseRepository.php'
            );

            $stub->render();
            $this->context->info("Base Repository Contracts Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
