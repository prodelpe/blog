<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Arr;
use Laravel\Scout\Builder;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Meilisearch\Client;

class Search extends Component
{
    public $allCategories;
    public $allUsers;

    public $searchResult = null;

    public ?string $searchString = null;

    public ?array $filters = [];
    public ?array $meiliFilters = [];

    public array $facets = ['category_id', 'user_id'];
    public ?string $lang = null;

    public function mount()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
        $this->allCategories = Category::all();
        $this->allUsers = User::all();
        $this->search();
    }

    public function render()
    {
        return view('livewire.search');
    }

    public function search()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $client = new Client(env('MEILISEARCH_HOST'));

        $this->searchResult = $client
            ->index("posts_{$lang}")
            ->search(trim($this->searchString) ?? '', [
                'filter' => $this->meiliFilters,
                'facets' => $this->facets
            ])->getRaw();
    }

    public function updatedFilters($value, $key)
    {
        // turns false to null
        if (!$value) {
            Arr::forget($this->filters, $key);
        }

        // removes empty filters
        foreach ($this->filters as $key => $value) {
            if (empty($value)) {
                unset($this->filters[$key]);
            }
        }

        $this->generateMeiliFilters();
        $this->search();
    }

    /**
     * Converts a filter array into a meilisearch readable array
     * https://docs.meilisearch.com/reference/api/search.html#filter
     * @return void
     */
    private function generateMeiliFilters(): void
    {
        $this->meiliFilters = [];
        $iteration = 0;
        foreach ($this->filters as $key => $filter) {
            foreach ($filter as $k => $f) {
                $this->meiliFilters[$iteration][] = "{$key} = {$filter[$k]}";
            }
            $iteration++;
        }
    }
}
