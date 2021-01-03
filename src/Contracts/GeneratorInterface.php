<?php

namespace Rekamy\Generator\Contracts;

interface GeneratorInterface {

    /**
     * 
     */
    public function loadConfig();

    /**
     * 
     */
    public function setPublishPath();

    /**
     * 
     */
    public function setTemplate();

    /**
     * Generate files 
     */
    public function generate();

}