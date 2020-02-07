<?php

namespace Rekamy\Generator\Console\Generator;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

trait ApiRequestGenerator
{
    public function generateApiRequests($outputDecorator)
    {
        try {
            $this->progress = $this->outputDecorator->createProgressBar(count($this->db['tables']));
            $this->progress->start();

            $this->output['rows'] = [];
            $separator = new TableSeparator;

            array_push($this->output['rows'], [new TableCell('<info>Requests</info>')]);
            array_push($this->output['rows'], $separator);

            foreach ($this->db['tables'] as $table) {
                $arrayPaths = [
                    [
                        "view" => view('apitemplate::CreateApiRequestTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                        "path" => app_path($this->path['api_request'] . '/Create' . ucfirst(Str::camel(Str::singular($table->TABLE_NAME)) . 'APIRequest.php'))
                    ],
                    [
                        "view" => view('apitemplate::UpdateApiRequestTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                        "path" => app_path($this->path['api_request'] . '/Update' . ucfirst(Str::camel(Str::singular($table->TABLE_NAME)) . 'APIRequest.php'))
                    ],
                ];

                foreach ($arrayPaths as $key => $value) {
                    $stub = new StubGenerator(
                        $value["view"],
                        $value["path"]
                    );
                    $stub->render([
                        $stub
                    ]);
                }
                $response = ucfirst(Str::camel(Str::singular($table->TABLE_NAME))) . " Request Successfully Created";

                array_push($this->output['rows'], ['<comment>' . $response . '</comment>']);

                $this->progress->advance();
                $outputDecorator->setRows($this->output['rows']);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
