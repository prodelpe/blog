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

<header class="container mx-auto my-4">
    <ul class="flex justify-end gap-4">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li class="border border-black p-2 hover:bg-black hover:text-white">
                <a class="uppercase" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $localeCode }}
                </a>
            </li>
        @endforeach
    </ul>
</header>

@livewire('search')

@livewireScripts
</body>
</html>
