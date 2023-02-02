<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Livewire\Component;

class Search extends Component
{
    public $posts;
    public $paginator;
    public $allCategories;
    public $allUsers;

    public $tempCategories;

    public ?string $searchString = null;

    public ?array $filters = [
        'users' => [],
        'categories' => [],
    ];

    public function mount()
    {
        $this->allUsers = User::all();
        $this->search();
    }

    public function render()
    {
        return view('livewire.search');
    }

    public function search($filter = true)
    {
        $this->posts = Post::search(trim($this->searchString) ?? '')
            ->query(function ($query) {
                $query
                    ->join('categories', 'posts.category_id', 'categories.id')
                    ->join('users', 'posts.user_id', 'users.id')
                    ->select([
                        'posts.id',
                        'posts.title',
                        'posts.content',
                        'categories.id as category_id',
                        'categories.name as category_name',
                        'categories.description as category_description',
                        'users.id as user_id',
                        'users.name as user_name',
                    ])
                    ->when(!empty($this->filters['categories']), function (Builder $query) {
                        $query->whereIn('category_id', $this->filters['categories']);
                    })
                    ->when(!empty($this->filters['users']), function (Builder $query) {
                        $query->whereIn('user_id', $this->filters['users']);
                    })
                    ->orderBy('posts.id', 'DESC');
            })
            ->paginate(20)
            ->toArray();

        if ($filter) {
            $this->searchCategories();
            $this->searchUsers();
        }
    }

    private function searchCategories()
    {
        $this->allCategories = Arr::sort(Arr::pluck($this->posts['data'], 'category_name', 'category_id'));
    }

    private function searchUsers()
    {
        $this->allUsers = Arr::sort(Arr::pluck($this->posts['data'], 'user_name', 'user_id'));
    }

    public function updatedFilters($value, $key)
    {
        if (!$value) {
            Arr::forget($this->filters, $key);
        }

        $this->search(false);
    }
}
