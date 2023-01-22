<?php

namespace Rekamy\Generator\Core;

use RuntimeException;

class StubGenerator
{
    /**
     * @var object
     */
    protected $context;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $target;

    /**
     * @param object $context Generator context
     * @param string $source String contents
     * @param string $target Target generated file
     */
    public function __construct(object $context, string $source, string $target)
    {
        $this->context = $context;
        $this->source = $source;
        $this->target = $target;
    }

    /**
     * @param array $replacements
     *
     * @throws \RuntimeException
     */
    public function render()
    {
        $overwrite = $this->context->config->options->overwrite;

        if ($this->target == base_path('routes/crud.php')) {
            $overwrite = true;
        }

        if (in_array($this->target, $this->context->config->options->dontOverwrite)) {
            $overwrite = false;
        }

        if (file_exists($this->target) && !$overwrite) {
            $this->context->error("Target $this->target already exists.");
            return;
        }

        $path = pathinfo($this->target, PATHINFO_DIRNAME);

        if (!file_exists($path)) mkdir($path, 0776, true);
        
        file_put_contents($this->target, $this->source);
    }
}
