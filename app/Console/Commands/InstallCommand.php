<?php

namespace App\Console\Commands;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
        $envFlag = 'FLASHCMS_INSTALLED';
        $installedConfigFlag = 'flashcms.installed';

        $installed = $this->laravel['config'][$installedConfigFlag];
        $forceInstall = $this->option('force');
        if (!$forceInstall && $installed) {
            $this->output->writeln('FlashCMS has been installed. if you need to reinstall, please use --force options');
            return true;
        }
        if ($forceInstall) {
            $this->warn('Waring: Please backup your database, all data will be lost after reinstall.');
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


        if ($forceInstall) {
            $this->info('drop tables...');

            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            //$this->call('migrate:rollback');

            Schema::dropIfExists('users');

            Schema::dropIfExists('password_resets');


            Schema::dropIfExists('cms_page');
            Schema::dropIfExists('cms_page_translations');

            Schema::dropIfExists('cms_block');
            Schema::dropIfExists('cms_block_translations');

            // drop table system_config
            Schema::dropIfExists('system_config');
            //drop product categroy table
            Schema::dropIfExists('category');
            Schema::dropIfExists('category_translations');

            //drop product table
            Schema::dropIfExists('product');
            Schema::dropIfExists('product_translations');

            //drop table product gallery
            Schema::dropIfExists('product_gallery');

            //drop table product video
            Schema::dropIfExists('product_video');


            //
            Schema::dropIfExists('product_variation');

            //drop table attribute
            Schema::dropIfExists('attribute');
            Schema::dropIfExists('attribute_translations');


            //drop table attribute
            Schema::dropIfExists('attribute_option');
            Schema::dropIfExists('attribute_option_translations');

            //drop table product attribute
            Schema::dropIfExists('product_attribute');


            //drop table product attribute value
            Schema::dropIfExists('product_attribute_option');

            //drop table category product idx
            Schema::dropIfExists('category_product_idx');

            Schema::dropIfExists('role_permissions');
            Schema::dropIfExists('permissions');
            Schema::dropIfExists('user_roles');
            Schema::dropIfExists('roles');

            Schema::dropIfExists('oauth_auth_codes');
            Schema::dropIfExists('oauth_access_tokens');
            Schema::dropIfExists('oauth_refresh_tokens');
            Schema::dropIfExists('oauth_clients');
            Schema::dropIfExists('oauth_personal_access_clients');


            Schema::dropIfExists($this->laravel['config']['database.migrations']);


            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }


        //$this->call('clear:cache'); // clear up cache
        $this->call('migrate');


        $this->call('db:seed', ['--class' => \InitSeeder::class]);


        $username = $this->ask('Enter your username');
        $email = $this->ask('Enter your email');

        while (true) {

            $password = $this->secret('Enter your password', 'password');
            $password_confirmation = $this->secret('Enter your password again', 'password');

            if ($password != $password_confirmation) {
                $this->warn('Waring: password didn\'t match, please re-enter.');
                continue;
            }
            break;
        }

        $role = Role::where('name', $this->laravel['config']['flashcms.role.super'])->first();
        if (!$role) {
            $this->error('Install failed, role ' . $this->laravel['config']['flashcms.role.super'] . ' not found');
            return false;
        }
        $user = new User();
        $user->name = $username;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();
        $user->roles()->attach($role);

        file_put_contents($this->laravel->environmentFilePath(),

            file_get_contents($this->laravel->environmentFilePath()) . 'FLASHCMS_INSTALLED=true'

        );


        $this->info('Install successful');
    }
}
