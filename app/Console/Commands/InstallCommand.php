<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcms:install {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install FlashCMS';

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
     * @return mixed
     */
    public function handle()
    {
        //

        $installedConfigFlag = 'flashcms.installed';

        $installed = $this->laravel['config'][$installedConfigFlag];
        $forceInstall = $this->option('force');

        if (!$forceInstall && $installed) {
            $this->output->writeln('FlashCMS has been installled. if you need to reinstall, please use --force options');
            return true;
        }


        $defaultConnection = $this->laravel['config']['database.default'];
        $connectionDetails = $this->laravel['config']['database.connections.' . $defaultConnection];

        $connection = $this->ask('What is your connection type?', 'mysql');
        $host = $this->ask('What is your database host?', '127.0.0.1');
        $port = $this->ask('What is your database port?', 3306);
        $database = $this->ask('What is your database name?', 'flashcms');
        $username = $this->ask('What is your database user?', 'root');
        $password = $this->secret('What is your database user\'s password?', 'password');

        file_put_contents($this->laravel->environmentFilePath(), str_replace(
            [
                'DB_CONNECTION=' . $defaultConnection,
                'DB_HOST=' . $connectionDetails['host'],
                'DB_PORT=' . $connectionDetails['port'],
                'DB_DATABASE=' . $connectionDetails['database'],
                'DB_USERNAME=' . $connectionDetails['username'],
                'DB_PASSWORD=' . $connectionDetails['password'],
            ],
            [
                'DB_CONNECTION=' . $connection,
                'DB_HOST=' . $host,
                'DB_PORT=' . $port,
                'DB_DATABASE=' . $database,
                'DB_USERNAME=' . $username,
                'DB_PASSWORD=' . $password,
            ],
            file_get_contents($this->laravel->environmentFilePath())
        ));
        $createDatabase = $this->ask('Do you want Splate to create the database for you', 'yes');
        if ($createDatabase == 'yes') {
            DB::connection($defaultConnection)->statement('CREATE DATABASE IF NOT EXISTS ' . $database);
        }
        $this->call('clear:cache'); // clear up cache
        $this->call('migrate');
    }
}
