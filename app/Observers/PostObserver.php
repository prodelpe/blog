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
//        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
//            $this->client->index("posts_{$lang}")->addDocuments([
//                [
//                    'id' => 287947,
//                    'title' => 'Shazam',
//                    'poster' => 'https://image.tmdb.org/t/p/w1280/xnopI5Xtky18MPhK40cZAGAOVeV.jpg',
//                    'overview' => 'A boy is given the ability to become an adult superhero in times of need with a single magic word.',
//                    'release_date' => '2019-03-23'
//                ]
//            ]);
//        }
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
