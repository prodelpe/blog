<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">

<div class="container mx-auto space-y-4 my-8 grid grid-cols-1 md:grid-cols-4">

    {{-- Form --}}
    <div>
        <form method="get" action="{{ route('posts.search') }}" class="space-y-4">
            <h2 class="font-bold">Search</h2>
            <input name="search" class="border broder-black p-2"/>

            <div>
                <h2 class="font-bold">Categories</h2>
                @foreach($categories as $category)
                    <div class="flex gap-2">
                        <input type="checkbox" name="category[]" value="{{ $category->id }}">
                        <label>{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>

            <div>
                <h2 class="font-bold">Users</h2>
                @foreach($users as $user)
                    <div class="flex gap-2">
                        <input type="checkbox" name="user[]" value="{{ $user->id }}">
                        <label>{{ $user->name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-black text-white p-2">Cercar</button>
        </form>
    </div>

    {{-- Results --}}
    <div class="col-span-3">
        @if(request()->routeIs('posts.search'))
            <div class="flex justify-between items-center">
                <div>
                    S'han trobat {{ $posts->total() }} resultats per la cerca
                </div>

                <div>
                    @if($posts->count())
                        {{ $posts->links() }}
                    @endif
                </div>
            </div>

            <hr class="my-4">
        @endif

        <div class="space-y-4">
            @foreach($posts as $post)
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h2 class="text-lg font-bold">{{ $post->id }} - {{ $post->title }}</h2>
                        <h3>By {{ $post->user->name }}</h3>
                        <h4 class="text-sm">Category: {{ $post->category->name }}</h4>
                    </div>
                    <div>
                        {!! $post->content !!}
                    </div>
                </div>
                <hr>
            @endforeach
        </div>

    </div>

    @if(request()->routeIs('posts.search') && $posts->count())
        {{ $posts->links() }}
    @endif

</div>
</body>
</html>
