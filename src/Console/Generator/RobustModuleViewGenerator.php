<?php

namespace Rekamy\Generator\Console\Generator;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

trait RobustModuleViewGenerator
{
    public function generateRobustModuleViews($outputDecorator)
    {
        try {
            $this->progress = $this->outputDecorator->createProgressBar(count($this->db['tables']));
            $this->progress->start();

            $this->output['rows'] = [];
            $separator = new TableSeparator;

            array_push($this->output['rows'], [new TableCell('<info>Module Views</info>')]);
            array_push($this->output['rows'], $separator);

            foreach ($this->db['tables'] as $table) {
                if ($this->template['own']) {
                    $arrayPaths = [
                        [
                            "view" => view()->file($this->template['module_views']['create'])->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/create.blade.php'
                        ],
                        [
                            "view" => view()->file($this->template['module_views']['show'])->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/show.blade.php'
                        ],
                        [
                            "view" => view()->file($this->template['module_views']['index'])->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/index.blade.php'
                        ],
                        [
                            "view" => view()->file($this->template['module_views']['edit'])->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/edit.blade.php'
                        ],
                        [
                            "view" => view()->file($this->template['module_views']['fields'])->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/fields.blade.php'
                        ],
                    ];
                } else {
                    $arrayPaths = [
                        [
                            "view" => view('robustlayouts::WebLayoutAppTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['layouts'] . '/app.blade.php'
                        ],
                        [
                            "view" => view('robustlayouts::WebLayoutAlertTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['layouts'] . '/alert.blade.php'
                        ],
                        [
                            "view" => view('robustlayouts::WebLayoutFooterTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['layouts'] . '/footer.blade.php'
                        ],
                        [
                            "view" => view('robustlayouts::WebLayoutHeaderTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['layouts'] . '/header.blade.php'
                        ],
                        [
                            "view" => view('robustlayouts::WebLayoutNavTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['layouts'] . '/nav.blade.php'
                        ],
                        [
                            "view" => view('robust::WebDefaultDashboardTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/dashboard.blade.php'
                        ],
                        [
                            "view" => view('robust::WebCreateViewsTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/create.blade.php'
                        ],
                        [
                            "view" => view('robust::WebShowViewsTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/show.blade.php'
                        ],
                        [
                            "view" => view('robust::WebIndexViewsTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/index.blade.php'
                        ],
                        [
                            "view" => view('robust::WebEditViewsTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/edit.blade.php'
                        ],
                        [
                            "view" => view('robust::WebFieldViewsTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/fields.blade.php'
                        ],
                        [
                            "view" => view('robustjs::WebCreateJSTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/js/create.js'
                        ],
                        [
                            "view" => view('robustjs::WebShowJSTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/js/show.js'
                        ],
                        [
                            "view" => view('robustjs::WebIndexJSTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/js/index.js'
                        ],
                        [
                            "view" => view('robustjs::WebEditJSTemplate')->with('db', (object) $this->db)->with('tablename', $table->TABLE_NAME)->with('context', $this),
                            "path" => $this->path['module_views'] . '/' . lcfirst(Str::singular(str_replace('_', '-', $table->TABLE_NAME))) . '/js/edit.js'
                        ],
                    ];
                }

                foreach ($arrayPaths as $key => $value) {
                    $stub = new StubGenerator(
                        $value["view"],
                        $value["path"]
                    );
                    $stub->render([
                        $stub
                    ]);
                }
                $response = ucfirst(Str::camel(Str::singular($table->TABLE_NAME))) . " Views Successfully Created";

                array_push($this->output['rows'], ['<comment>' . $response . '</comment>']);

                $this->progress->advance();
                $outputDecorator->setRows($this->output['rows']);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function recurse_copy()
    {
        $src = __DIR__ . '/../../resources/views/GeneratorTemplates/web/robust-theme-template/public';
        $dir = opendir($src);
        $dst = public_path();
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    dd($src . '/' . $file, $dst . '/' . $file);
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    dd($src . '/' . $file, $dst . '/' . $file);
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public function countRobustPublicFiles()
    {
        $src = realpath(__DIR__ . '/../../resources/views/GeneratorTemplates/web/robust-theme-template/public/');
        $dst = realpath(public_path());

        exec("cp -vr " . $src . " " . $dst);
        dd($src, $dst);

        $di = new RecursiveDirectoryIterator(realpath(__DIR__ . '/../../resources/views/GeneratorTemplates/web/robust-theme-template/public'));
        $arr = [];
        foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
            $path = str_replace("", '', $filename);

            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        die;

        $this->progress = $this->outputDecorator->createProgressBar(count($arr));
        $this->progress->start();

        foreach ($arr as $key => $value) {
            dd($value);
            if (strpos($value, "") !== false) {
                dd($value);
            }

            if (strpos($path, '/.') || strpos($path, '/files/.')) {
                copy(realpath($filename), public_path($path));
            }

            $this->progress->advance();
        }
        die;

        $this->progress->finish();
    }
}
