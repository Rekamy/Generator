<?php

namespace Rekamy\Generator\Core\Generators\Backend;

use DB;
use Rekamy\Generator\Core\StubGenerator;

class HasAuditorRelationGenerator
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
        $this->context->info("Creating HasAuditor Relation Trait...");
    }

    public function generate()
    {
        try {
            $view = view('backend::HasAuditorRelations')
                ->with('context', $this->context);

            $stub = new StubGenerator(
                $this->context,
                $view->render(),
                $this->context->path['backend']['has_auditor_relation_trait']['path'] . 'HasAuditorRelations.php'
            );

            $stub->render();
            $this->context->info("HasAuditorRelations Trait Created.");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
