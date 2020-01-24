<?php

namespace Rekamy\ApiGenerator\Console\Generator;

use DB;
use Rekamy\ApiGenerator\Console\RuleParser;
use Rekamy\ApiGenerator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

trait RequestGenerator
{
    public function generateRequests($outputDecorator)
    {
        try {
            $this->output['rows'] = [];
            $separator = new TableSeparator;

            array_push($this->output['rows'], [new TableCell('<info>Requests</info>')]);
            array_push($this->output['rows'], $separator);

            foreach ($this->db['tables'] as $table) {
                $arrayPaths = [
                    [
                        "view" => view('template::CreateRequestTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                        "path" => app_path('Http/Requests/API/Create' . ucfirst(Str::camel(Str::singular($table->TABLE_NAME)) . 'APIRequest.php'))
                    ],
                    [
                        "view" => view('template::UpdateRequestTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                        "path" => app_path('Http/Requests/API/Update' . ucfirst(Str::camel(Str::singular($table->TABLE_NAME)) . 'APIRequest.php'))
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

                $outputDecorator->setRows($this->output['rows']);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
