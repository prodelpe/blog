<div class="container mx-auto space-y-4 my-8 grid grid-cols-1 md:grid-cols-4 gap-8" xmlns="http://www.w3.org/1999/html">

    {{-- Form --}}
    <div class="space-y-2">
        <div class="p-4 rounded bg-gray-100 space-y-2">
            <h2 class="font-bold">Search</h2>
            <input class="border broder-black p-2" wire:model.defer="searchString"/>
            <button type="button" class="p-2 bg-black text-white" wire:click="search">Search</button>
        </div>

        <div class="p-4 rounded bg-gray-100 space-y-2">
            <div>
                <h2 class="font-bold">Categories</h2>
                @foreach($allCategories as $key => $value)
                    <div class="flex gap-2">
                        <input type="checkbox"
                               wire:key="filters.category-{{ $key }}"
                               wire:model="filters.categories.{{ $key }}"
                               value="{{ $key }}"
                        >
                        <label>{{ $value }}</label>
                    </div>
                @endforeach
            </div>

            <div>
                <h2 class="font-bold">Users</h2>
                @foreach($allUsers as $key => $value)
                    <div class="flex gap-2">
                        <input type="checkbox"
                               wire:key="filters.user-{{ $key }}"
                               wire:model="filters.users.{{ $key }}"
                               value="{{ $key }}"
                        >
                        <label>{{ $value }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Results --}}
    <div class="col-span-3">

            <div class="flex justify-between items-center">
                <div>
                    S'han trobat {{ $posts['total'] }} resultats per la cerca
                </div>

                <div>
                    @if($posts['last_page'] > 1)
                        @isset($posts['prev_page_url'])
                            <a href="{{ $posts['prev_page_url'] }}">Prev</a>
                        @endisset
                        @isset($posts['next_page_url'])
                            <a href="{{ $posts['next_page_url'] }}">Next</a>
                        @endisset
                    @endif
                </div>
            </div>

            <hr class="my-4">

        <div class="space-y-4">
            @foreach($posts['data'] as $key => $post)
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h2 class="text-lg font-bold">{{ $post['id'] }} - {{ $post['title'] }}</h2>
                        <h3>By {{ $post['user_name'] }}</h3>
                        <h4 class="text-sm">Category: {{ $post['category_name'] }}</h4>
                    </div>
                    <div>
                        {!! $post['content'] !!}
                    </div>
                </div>
                <hr>
            @endforeach
        </div>

        <hr>

        <div class="flex justify-end gap-2 mt-4">
            @if($posts['last_page'] > 1)
                @isset($posts['prev_page_url'])
                    <a href="{{ $posts['prev_page_url'] }}">Prev</a>
                @endisset
                @isset($posts['next_page_url'])
                    <a href="{{ $posts['next_page_url'] }}">Next</a>
                @endisset
            @endif
        </div>

    </div>

</div>
