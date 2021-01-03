<?php

namespace Rekamy\Generator\Core;

use Rekamy\Generator\Core\Generators\ModelGenerator;

class Factory
{
    /**
     * @GeneratorInterface 
     */
    protected $generator;

    public function __construct($context, $type)
    {
        switch ($type) {
            case 'model':
                return new ModelGenerator($context); 
                break;
            
            default:
                # code...
                break;
        }
    }

    public function generate()
    {
        $this->generator->generate();
    }
}
