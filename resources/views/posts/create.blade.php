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
    <form method="post" action="{{ route('posts.store') }}" class="space-y-4 my-4">
        @csrf
        <input class="w-full border border-black" type="text" name="title"/>
        <textarea class="h-24 w-full border border-black" name="content"></textarea>
        <input class="border border-black p-2" type="submit" value="Submit">
    </form>
</div>

</body>
</html>
