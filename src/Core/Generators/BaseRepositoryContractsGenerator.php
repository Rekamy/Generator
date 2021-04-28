<?php

namespace Rekamy\Generator\Core\Generators;

use Rekamy\Generator\Console\StubGenerator;

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
            $view = view('backend::BaseRepository')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['override'] . 'BaseRepository.php'
            );

            $stub->render();
            $this->context->info("Base Repository Contracts Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
