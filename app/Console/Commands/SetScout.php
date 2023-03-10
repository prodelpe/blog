<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetScout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set-scout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posa en marxa Scout en aquest projecte';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('scout:sync-index-settings');
        //Artisan::call('scout:import ' . Post::class);
        //Artisan::call('create-indexes');
        //Artisan::call('queue:work --queue=redis');
        return Command::SUCCESS;
    }
}
