<?php

namespace Rekamy\Generator\Console\Commands;

use Illuminate\Console\Command;
use Rekamy\Generator\Core\BuildConfig;

class InitGenerator extends Command
{
    use BuildConfig;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate boilerplate for the whole project';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->loadConfig();
        $answerCollection = collect();

        if ($this->confirm('Generate migration from current database?')) {
            $answerCollection->push('generate:migration');
        } else {
            if ($this->confirm('Run fresh migration?'))
                $answerCollection->push('migrate:fresh --seed');
        }

        if ($this->confirm('Generate backend from current database?'))
            $answerCollection->push('generate:backend');

        if ($this->confirm('Generate frontend from current database?'))
            $answerCollection->push('generate:frontend');

        $answerCollection->each(fn ($command) => $this->call($command));
    }
}
