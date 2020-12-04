<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\ProgressBar;

class SyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'koel:sync
        {record? : A single watch record. Consult Wiki for more info.}
        {--tags= : The comma-separated tags to sync into the database}
        {--force : Force re-syncing even unchanged files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync songs found in configured directory against the database.';

    /**
     * @var ProgressBar
     */
    private $progressBar;

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
        return 0;
    }

    public function createProgressBar(int $max)
    {
        $this->progressBar = $this->getOutput()->createProgressBar($max);
    }
}
