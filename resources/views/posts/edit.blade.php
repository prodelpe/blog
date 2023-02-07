<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">

<div class="container mx-auto my-4">
    <form method="post" action="{{ route('posts.update', $post->id) }}" class="space-y-4 my-4">
        @csrf
        title
        <input class="w-full border border-black" type="text" name="title" value="{{ $post->title }}"/>
        body
        <textarea class="h-24 w-full border border-black" name="body">{{ $post->body }}</textarea>
        user
        <input class="w-full border border-black" type="number" name="user_id" value="{{ $post->user_id }}"/>
        category
        <input class="w-full border border-black" type="number" name="category_id" value="{{ $post->category_id }}"/>

        <input class="border border-black p-2" type="submit" value="Submit">
    </form>

    <form method="post" action="{{ route('posts.delete', ['id' => $post->id]) }}">
        @csrf
        <input class="border border-black p-2" type="submit" value="Delete">
    </form>
</div>

</body>
</html>
