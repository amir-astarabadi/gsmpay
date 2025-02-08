<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Artisan;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'config base requirement of systsm';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->setAppKey();
        $this->resetConfig();
        $this->linkStorage();
        $this->setJWTSecret();
        $this->runMigrations();

        if (!app()->isProduction()) {
            $this->seedDatabase();
        }
    }

    private function setAppKey()
    {
        if (empty(config('app.key'))) {
            Artisan::call('key:generate', ['--force' => true]);
        }
    }

    private function setJWTSecret()
    {
        if (empty(config('jwt.secret'))) {
            Artisan::call('jwt:secret', ['--force' => true]);
        }
    }

    private function resetConfig()
    {
        Artisan::call('config:cache');
    }

    private function linkStorage()
    {
        Artisan::call('storage:link');
    }

    private function runMigrations()
    {
        Artisan::call('migrate', ['--force' => true]);
    }


    private function seedDatabase()
    {
        Artisan::call('db:seed', ['--force' => true]);
    }
}
