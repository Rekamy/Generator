<?php

namespace Rekamy\Generator\Core\Generators\Workflow;

class RequestGenerator
{
    public function __construct( $context)
    {
        $this->context = $context;
        $this->context->info("Creating APIDoc...");
        $this->tables = $this->context->getTables();
    }

    public function getAttributes()
    {
        
    }
}