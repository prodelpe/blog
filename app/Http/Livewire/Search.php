<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Arr;
use Laravel\Scout\Builder;
use Livewire\Component;
use Meilisearch\Endpoints\Indexes;

class Search extends Component
{
    public $paginator;
    public $allCategories;
    public $allUsers;

    public $scoutBuilder;

    public $searchResult = null;

    public ?string $searchString = null;

    public ?array $filters = [];

    public array $facets = ['category_id', 'user_id'];

    public function mount()
    {
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
        $this->searchResult = Post::search(trim($this->searchString) ?? '')
            ->options(['facets' => $this->facets])
            ->when(!empty($this->filters), function (Builder $query) {
                foreach ($this->filters as $key => $values) {
                    $query->whereIn($key, $values);
                }
            })
            ->raw();
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

        $this->search();
    }
}
