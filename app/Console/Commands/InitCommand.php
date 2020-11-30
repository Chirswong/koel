<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Kernel as Artisan;

class InitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'koel:init {--no-assets}';
    protected $description = 'Install or upgrade Koel';

    private $artisan;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        Artisan $artisan
    )
    {
        parent::__construct();
        $this->artisan = $artisan;
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
}
