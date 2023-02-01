<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Scout\Builder;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        $users = User::all();

        return view('posts.index', compact('posts', 'categories', 'users'));
    }

    public function search(Request $request)
    {
        $posts = Post::search($request->search)
            ->when(!is_null($request->user), function (Builder $query) use ($request) {
                $query->whereIn('user_id', $request->user);
            })
            ->when(!is_null($request->category), function (Builder $query) use ($request) {
                $query->whereIn('category_id', $request->category);
            })
            ->paginate(20);

        $categories = Category::all();
        $users = User::all();

        return view('posts.index', compact('posts', 'categories', 'users'));
    }
}
