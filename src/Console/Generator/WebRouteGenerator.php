<?php

namespace Rekamy\Generator\Console\Generator;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

trait WebRouteGenerator
{
    public function generateWebRoutes($outputDecorator)
    {
        try {
            $this->progress = $this->outputDecorator->createProgressBar(count($this->db['tables']));
            $this->progress->start();

            $this->output['rows'] = [];
            $separator = new TableSeparator;

            array_push($this->output['rows'], [new TableCell('<info>Web Routes</info>')]);
            array_push($this->output['rows'], $separator);

            foreach ($this->db['tables'] as $table) {
                $view = view('webtemplate::CreateWebRouteTemplate')
                    ->with('db', (object) $this->db)
                    ->with('tablename', $table->TABLE_NAME);

                    $stub = new StubGenerator(
                        $view->render(),
                        $this->path['web_routes']
                    );

                $stub->render([
                    $stub
                ]);
                $response = ucfirst(Str::camel(Str::singular($table->TABLE_NAME))) . " Route Successfully Created";

                $this->progress->advance();
                array_push($this->output['rows'], ['<comment>' . $response . '</comment>']);
            }
            $outputDecorator->setRows($this->output['rows']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
