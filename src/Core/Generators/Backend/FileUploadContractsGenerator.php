<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use Rekamy\Generator\Core\StubGenerator;

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
            $view = view('backend::utils.FileUpload')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->config->setup->backend->utilities->path . 'FileUpload.php'
            );

            $stub->render();
            $this->context->info("File Upload Contracts Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
