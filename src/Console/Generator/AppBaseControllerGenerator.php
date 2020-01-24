<?php

namespace Rekamy\ApiGenerator\Console\Generator;

use DB;
use Rekamy\ApiGenerator\Console\RuleParser;
use Rekamy\ApiGenerator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

trait AppBaseControllerGenerator
{
    public function generateAppBaseController($outputDecorator)
    {
        try {
            $this->output['rows'] = [];
            $separator = new TableSeparator;

            array_push($this->output['rows'], [new TableCell('<info>App Base Controller</info>')]);
            array_push($this->output['rows'], $separator);

            $view = view('template::CreateAppBaseControllerTemplate')
                ->with('db', (object) $this->db)
                ->with('context', $this);

            $stub = new StubGenerator(
                $view->render(),
                $this->path['app_base_controller'] . 'AppBaseController.php'
            );

            $stub->render([
                $stub
            ]);

            $response = "App Base Controller Successfully Created";

            array_push($this->output['rows'], ['<comment>' . $response . '</comment>']);

            $outputDecorator->setRows($this->output['rows']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
