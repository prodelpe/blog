<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Meilisearch\Client;
use Spatie\Translatable\Translatable;

class IndexController extends Controller
{
    public Client $client;

    public function __construct()
    {
        $this->client = new Client(env('MEILISEARCH_HOST'));
    }

    public function index()
    {
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            $posts = Post::all()->map(function ($item) use ($lang) {
                return $item->getTranslatedData($lang);
            })->toArray();

            $this->client->index("posts_{$lang}")->addDocuments($posts);
        }
    }

    public function cinema()// Demo from meilisearch docs
    {
        $movies_json = file_get_contents('movies.json');
        $movies = json_decode($movies_json);
        $this->client->index('movies')->addDocuments($movies);
    }
}
