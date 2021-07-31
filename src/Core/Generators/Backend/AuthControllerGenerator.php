<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class AuthControllerGenerator
{
    private $context;


    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating AuthController...");
    }

    public function generate()
    {
        try {
            $data['context'] = $this->context;

            $view = view('backend::controller.AuthController', $data);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['auth_controller']['path'] . 'AuthController.php'
            );

            $stub->render();
            $this->context->info("AuthController Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
