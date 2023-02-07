<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Artisan;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Meilisearch\Client;

class PostObserver
{
    public Client $client;

    public function __construct()
    {
        $this->client = new Client(env('MEILISEARCH_HOST'));
    }

    /**
     * Handle the Post "created" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function created(Post $post)
    {
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            $this->client->index("posts_{$lang}")->addDocuments([
                [
                    'title' => $post->getTranslation('title', $lang),
                    'body' => $post->getTranslation('body', $lang),
                    'user_id' => $post->user_id,
                    'category_id' => $post->category_id
                ]
            ]);
        }
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function updated(Post $post)
    {
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function deleted(Post $post)
    {
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function restored(Post $post)
    {
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
    }
}
