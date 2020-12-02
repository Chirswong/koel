<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Jackiedo\DotenvEditor\DotenvEditor;
use Illuminate\Database\DatabaseManager as DB;
use App\Exceptions\InstallationFailedException;
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

    private $db;
    private $artisan;
    private $dotenvEditor;

    /**
     * Create a new command instance.
     *
     * @param Artisan $artisan
     * @param DotenvEditor $dotenvEditor
     */
    public function __construct(
        DB $db,
        Artisan $artisan,
        DotenvEditor $dotenvEditor
    )
    {
        parent::__construct();
        $this->db = $db;
        $this->artisan = $artisan;
        $this->dotenvEditor = $dotenvEditor;
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
        $this->info('📙  ' . config('koel.misc.docs_url') . PHP_EOL);

        if ($this->inNoInteractionMode()) {
            $this->info('Running in no-interaction mode');
        }

        try {
            $this->maybeGenerateAppKey();
            $this->maybeSetUpDatabase();
            $this->maybeSeedDatabase();
            $this->maybeCompileFrontEndAssets();
        } catch (\Exception $e) {
            $this->error("Oops! Koel installation or upgrade didn't finish successfully.");
            $this->error('Please try again, or visit ' . config('koel.misc.docs_url') . ' for manual installation.');
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

    public function maybeGenerateAppKey(): void
    {
        if (!config('app.key')) {
            $this->info('Generate app key');
            $this->artisan->call('key:generate');
        }else{
            $this->comment('App Key exists -- skipping');
        }
    }

    public function maybeSetUpDatabase(): void
    {
        while (true){
            try {
                // make sure the config cache is cleared before another attempt.
                $this->artisan->call('config:clear');
                $this->db->reconnect()->getPdo();
                break;
            }catch (\Exception $exception){
                $this->error($exception->getMessage());
                $this->warn(PHP_EOL."Koel cannot connect to the database. Let's set it up");
                $this->setUpDatabase();
            }
        }
    }

    public function migrateDatabase(): void
    {
        $this->info('Migrating database');
        $this->artisan->call('migrate',['--force' => true]);
    }

    public function maybeSeedDatabase(): void
    {
        if (!User::count()){
            $this->setUpDatabase();
            $this->info('Seeding initial data');
            $this->artisan->call('db:seed',['--force' => true]);
        }else{
            $this->comment('Data seeded -- skipping');
        }
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
        if (is_dir('node_modules')){
            return;
        }
        $this->info('├── Installing Node modules in resources/assets directory');

        $runOkOrThrow = static function ($command) {
            passthru($command, $status);
            throw_if((bool)$status, InstallationFailedException::class);
        };

        $runOkOrThrow('yarn install --colors');

        chdir('../..');
        if (is_dir('node_modules')){
            return;
        }
        $this->info('└── Compiling assets');

        $runOkOrThrow('yarn install --colors');
        $runOkOrThrow('yarn production --colors');
    }

    private function setUpDatabase()
    {
        $config = [
            'DB_CONNECTION' => '',
            'DB_HOST' => '',
            'DB_PORT' => '',
            'DB_DATABASE' => '',
            'DB_USERNAME' => '',
            'DB_PASSWORD' => ''
        ];

        $config['DB_CONNECTION'] = $this->choice(
            'Your DB driver of choice',
            [
                'mysql' => 'MySQL/MariaDB',
                'pgsql' => 'PostgreSQL',
                'sqlsrv' => 'SQL Server',
                'sqlite-e2e' => 'SQLite'
            ],
            'mysql');

        if ($config['DB_CONNECTION'] === 'sqlite-e2e') {
            $config['DB_DATABASE'] = $this->ask('Absolute path to the DB file');
        } else {
            $config['DB_HOST'] = $this->anticipate('DB host', ['127.0.0.1', 'localhost']);
        }

        foreach ($config as $key => $value) {
            $this->dotenvEditor->setKey($key, $value);
        }
        $this->dotenvEditor->save();

        config([
            'database.default' => $config['DB_CONNECTION'],
            "database.connections.{$config['DB_CONNECTION']}.host" => $config['DB_HOST'],
            "database.connections.{$config['DB_CONNECTION']}.port" => $config['DB_PORT'],
            "database.connections.{$config['DB_CONNECTION']}.database" => $config['DB_DATABASE'],
            "database.connections.{$config['DB_CONNECTION']}.username" => $config['DB_USERNAME'],
            "database.connections.{$config['DB_CONNECTION']}.password" => $config['DB_PASSWORD'],
        ]);
    }
}
