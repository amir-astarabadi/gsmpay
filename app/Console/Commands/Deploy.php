<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
        $this->resetConfig();
        $this->setJWTSecret();
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
}
