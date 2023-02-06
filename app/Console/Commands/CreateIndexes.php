<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Meilisearch\Client;

class CreateIndexes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-indexes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates indexes by language';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client(env('MEILISEARCH_HOST'));

        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            $posts = Post::all()->map(function ($item) use ($lang) {
                return $item->getTranslatedData($lang);
            })->toArray();

            $client->index("posts_{$lang}")->addDocuments($posts);
            $client->index("posts_{$lang}")->updateFilterableAttributes(['user_id', 'category_id']);
            //$client->index("posts_{$lang}")->updateSearchableAttributes(['title', 'content']);
            $client->index("posts_{$lang}")->updateSortableAttributes(['updated_at']);
        }

        return Command::SUCCESS;
    }
}
