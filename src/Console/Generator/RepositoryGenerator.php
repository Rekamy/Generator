<?php

namespace Rekamy\ApiGenerator\Console\Generator;

use DB;
use Rekamy\ApiGenerator\Console\RuleParser;
use Rekamy\ApiGenerator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

trait RepositoryGenerator
{
    public function generateRepositories($outputDecorator)
    {
        try {
            $this->output['rows'] = [];
            $separator = new TableSeparator;

            array_push($this->output['rows'], [new TableCell('<info>Repositories</info>')]);
            array_push($this->output['rows'], $separator);

            foreach ($this->db['tables'] as $table) {
                $view = view('template::CreateRepositoryTemplate')
                    ->with('db', (object) $this->db)
                    ->with('context', $this)
                    ->with('tablename', $table->TABLE_NAME);

                $stub = new StubGenerator(
                    $view->render(),
                    $this->path['repository'] . ucfirst(Str::camel(Str::singular($table->TABLE_NAME))) . 'Repository.php'
                );

                $stub->render([
                    $stub
                ]);
                $response = ucfirst(Str::camel(Str::singular($table->TABLE_NAME))) . " Repository Successfully Created";

                array_push($this->output['rows'], ['<comment>' . $response . '</comment>']);
            }
            $outputDecorator->setRows($this->output['rows']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
