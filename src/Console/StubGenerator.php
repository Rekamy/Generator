<?php

namespace Rekamy\Generator\Console;

use RuntimeException;

class StubGenerator
{
    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $target;

    /**
     * @param string $source
     * @param string $target
     */
    public function __construct(string $source, string $target)
    {
        $this->source = $source;
        $this->target = $target;
    }

    /**
     * @param array $replacements
     *
     * @throws \RuntimeException
     */
    public function render($overwrite = false)
    {
        if (file_exists($this->target) && !$overwrite) {
            // throw new RuntimeException('Cannot generate file. Target ' . $this->target . ' already exists.');
            dump("Target $this->target already exists.");

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
