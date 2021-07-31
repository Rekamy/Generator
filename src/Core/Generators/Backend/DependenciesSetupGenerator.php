<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class DependenciesSetupGenerator
{
    private $context;


    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Setup for dependencies configuration...");
    }

    public function generate()
    {
        try {
            $view = view('backend::config.auth');

            $authConfigStub = new StubGenerator(
                $this->context,
                $view->render(),
                config_path('auth.php')
            );

            $view = view('backend::UserModel');

            $userModelStub = new StubGenerator(
                $this->context,
                $view->render(),
                app_path('Models\User.php')
            );

            $authConfigStub->render();
            $userModelStub->render();
            $this->context->info("Setup for laravel passport completed.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
