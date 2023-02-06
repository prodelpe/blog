<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Arr;
use Laravel\Scout\Builder;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Search extends Component
{
    public $allCategories;
    public $allUsers;

    public $searchResult = null;

    public ?string $searchString = null;

    public ?array $filters = [];

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


        $this->searchResult = Post::search(trim($this->searchString) ?? '')
            ->within("posts_{$this->lang}")
            ->options([
                'facets' => $this->facets
            ])
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
