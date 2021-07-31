<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class APIDocInfoGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating APIDoc...");
    }

    public function generate()
    {
        try {
            $this->context->info("Creating APIDoc info ...");

            $data['context'] = $this->context;
            $data['title'] = config('app.name');
            $data['description'] = config('app.name') . ' API Documentation';
            $data['version'] = '1.0.0';
            $view = view('swagger::APIDocInfo', $data);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['api_doc'] . 'APIDocInfo.php'
            );

            $stub->render();
            $this->context->info("APIDoc Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
