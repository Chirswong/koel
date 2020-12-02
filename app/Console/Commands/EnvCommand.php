<?php

namespace App\Console\Commands;

use App\Exceptions\InstallationFailedException;
use Illuminate\Console\Command;

class EnvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $runOkOrThrow = static function (string $command): void {
            passthru($command, $status);
            throw_if((bool)$status, InstallationFailedException::class);
        };
        chdir('./');
        $runOkOrThrow('rm -rf .env');
        $runOkOrThrow('cp .env.example .env');
        $this->info('success');
        return 0;
    }
}
