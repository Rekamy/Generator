<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\RuleParser;
use Rekamy\Generator\Core\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class RequestGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Request...");
        $this->tables = $this->context->getTables();
    }

    public function generate()
    {
        try {
            foreach ($this->tables as $table) {
                $this->context->info("Creating Request for table $table ...");

                $name = Str::of($table);
                $data['context'] = $this->context;
                $data['table'] = $name;
                $data['model'] = $name->singular()->studly();
                $data['columns'] = $this->context->getColumns($table);
                $data['rules'] = $this->drawRules($data['columns']);
                $data['className'] = $name->singular()->studly() . "Request";
                $data['blocName'] = $name->singular()->studly() . "Bloc";

                $view = view('backend::Request', $data);

                $stub = new StubGenerator(
                    $this->context,
                    $view->render(),
                    $this->context->config->setup->backend->request->path . $data['className'] . '.php'
                );

                $stub->render();
                $this->context->info("Request Created.");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function drawRules($columns)
    {

        $columns = collect($columns)->except([
            'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'status',
        ]);
        $rules = '';
        foreach ($columns as $column) {
            $name = $column->getName();
            $ruleList = [];

            if ($type = RuleParser::parseType($column)) $ruleList[] = $type;

            if ($column->getNotNull()) $ruleList[] = 'required';

            if (!sizeof($ruleList)) continue;

            if ($column->getLength()) $ruleList[] = 'max:' . $column->getLength();

            $rule = trim(implode("|", $ruleList), "|");

            $rules .= "\n\t\t\t'{$name}' => '{$rule}',";
        }
        // dump($rules);
        return $rules;
    }
}
