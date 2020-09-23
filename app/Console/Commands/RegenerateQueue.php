<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegenerateQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nqueue:regen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate queue';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \App\Jobs\RegenerateQueue::dispatchSync();
    }
}
