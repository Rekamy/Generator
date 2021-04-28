<?php

namespace Rekamy\Generator\Core\Generators;

use Rekamy\Generator\Console\StubGenerator;

class FileUploadContractsGenerator
{
    private $context;
 
    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating File Upload Contracts...");
    }

    public function generate()
    {
        try {
            $view = view('backend::FileUpload')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['utilities'] . 'FileUpload.php'
            );

            $stub->render();
            $this->context->info("File Upload Contracts Created.");

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
