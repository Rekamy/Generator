<?php

namespace Rekamy\Generator\Core\Generators;

use DB;
use Rekamy\Generator\Console\RuleParser;
use Rekamy\Generator\Console\StubGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

class DashboardGenerator
{
    private $context;

    private $tables;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating Dashboard file...");
        $this->tables = collect($this->context->db->listTableNames())
            ->filter(function ($item) {
                return !in_array($item, $this->context->excludeTables);
            });
    }

    public function generate()
    {
        try {
            $view = view('frontend::Argon/template/packageJson');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/package.json")
            );

            $stub->render();
            $this->context->info("Frontend file Created.");
            $this->context->info("Package.json Created.");
            $this->generateTsConfig();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateTsConfig()
    {
        try {
            $view = view('frontend::Argon/template/tsconfigJson');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/tsconfig.json")
            );

            $stub->render();
            $this->context->info("Tsconfig.json Created.");
            $this->generateVueConfig();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateVueConfig()
    {
        try {
            $view = view('frontend::Argon/template/vueconfigJs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/vue.config.js")
            );

            $stub->render();
            $this->context->info("Vueconfig.js Created.");
            $this->generateBabel();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateBabel()
    {
        try {
            $view = view('frontend::Argon/template/babelconfigJs');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/babel.config.js")
            );

            $stub->render();
            $this->context->info("Babelconfig.js Created.");
            $this->generateBrowserlistrc();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateBrowserlistrc()
    {
        try {
            $view = view('frontend::Argon/template/browserlistrc');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/.browserslistrc")
            );

            $stub->render();
            $this->context->info("Browserslistrc Created.");
            $this->generateEnv();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateEnv()
    {
        try {
            $view = view('frontend::Argon/template/env');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/.env")
            );

            $stub->render();
            $this->context->info("Env Created.");
            $this->generateEnvExample();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateEnvExample()
    {
        try {
            $view = view('frontend::Argon/template/envExample');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/.env.example")
            );

            $stub->render();
            $this->context->info("Env.Example Created.");
            $this->generateGitIgnore();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateGitIgnore()
    {
        try {
            $view = view('frontend::Argon/template/gitIgnore');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/.gitignore")
            );

            $stub->render();
            $this->context->info("Gitignore Created.");
            $this->generateReadMe();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateReadMe()
    {
        try {
            $view = view('frontend::Argon/template/readmeMd');

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                resource_path("frontend/README.md")
            );

            $stub->render();
            $this->context->info("README Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
