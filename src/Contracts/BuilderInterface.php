<?php

namespace Rekamy\Generator\Contracts;

interface BuilderInterface {
    /**
     * register factory
     */
    public function makeFactory();

    /**
     * push generator to stack
     */
    public function addStack($generator);
}