<?php

namespace App\Console\Commands;

use App\Exceptions\InstallationFailedException;
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
     *
     */
    public function handle()
    {
        $this->comment('Attempting to install or upgrade Koel.');
        $this->comment('Remember, you can always install/upgrade manually following the guide here:');
        $this->info('📙  '.config('koel.misc.docs_url').PHP_EOL);

        if ($this->inNoInteractionMode()) {
            $this->info('Running in no-interaction mode');
        }

        try {
            $this->maybeCompileFrontEndAssets();
        } catch (\Exception $e) {
            $this->error("Oops! Koel installation or upgrade didn't finish successfully.");
            $this->error('Please try again, or visit '.config('koel.misc.docs_url').' for manual installation.');
            $this->error('😥 Sorry for this. You deserve better.');

            return;
        }
    }

    private function inNoInteractionMode()
    {
        return (bool)$this->option('no-interaction');
    }

    private function inNoAssetsMode()
    {
        return (bool)$this->option('no-assets');
    }

    private function maybeCompileFrontEndAssets()
    {
        if ($this->inNoAssetsMode()) {
            return;
        }

        $this->info('Now to front-end stuff');

        // We need to run several yarn commands:
        // - The first to install node_modules in the resources/assets submodule
        // - The second and third for the root folder, to build Koel's front-end assets with Mix.

        chdir('./resources/assets');
        $this->info('├── Installing Node modules in resources/assets directory');

        $runOkOrThrow = static function ($command) {
            passthru($command, $status);
            throw_if((bool) $status, InstallationFailedException::class);
        };

        $runOkOrThrow('yarn install --colors');

        chdir('../..');
        $this->info('└── Compiling assets');

        $runOkOrThrow('yarn install --colors');
        $runOkOrThrow('yarn production --colors');
    }
}
