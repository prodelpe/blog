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
        return view('posts.index');
    }
}
