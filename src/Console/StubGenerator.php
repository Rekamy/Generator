<?php

namespace Rekamy\Generator\Console;

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
        $overwrite = true;

        if (in_array($this->target, $this->context->options->get('dontOverwrite'))) {
            $overwrite = false;
        }

        if (file_exists($this->target) && !$overwrite) {
            // throw new RuntimeException('Cannot generate file. Target ' . $this->target . ' already exists.');
            $this->context->error("Target $this->target already exists.");

            // dd("Target $this->target already exists.");
        } else {

            // Standard replacements
            // collect($replacements)->each(function (string $replacement, string $tag) use (&$this->source) {
            //     $this->source = str_replace($tag, $replacement, $this->source);
            // });

            $path = pathinfo($this->target, PATHINFO_DIRNAME);

            if (!file_exists($path)) {
                mkdir($path, 0776, true);
            }

            file_put_contents($this->target, $this->source);
        }
    }
}
