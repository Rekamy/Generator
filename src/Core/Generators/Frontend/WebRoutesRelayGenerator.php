<?php

namespace Rekamy\Generator\Core\Generators\Frontend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class WebRoutesRelayGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Web Routes Relay...");
    }

    public function generate()
    {
        try {
            $view = view('backend::routes.WebVueRoutes');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['web_routes']['path']
            );

            $stub->render();
            $this->context->info("Api Route Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
