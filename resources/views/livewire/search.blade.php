<div class="container mx-auto space-y-4 my-8 grid grid-cols-1 md:grid-cols-4 gap-8" xmlns="http://www.w3.org/1999/html">

    {{-- Form --}}
    <div class="space-y-2">
        <div class="p-4 rounded bg-gray-100 space-y-2">
            <h2 class="font-bold">Search</h2>
            <input class="border broder-black p-2" wire:model.defer="searchString"/>
            <button type="button" class="p-2 bg-black text-white" wire:click="search">Search</button>
        </div>

        <div class="p-4 rounded bg-gray-100 space-y-4">
            <div>
                <h2 class="font-bold">Categories</h2>
                @foreach($allCategories as $key => $category)
                    <div class="flex gap-2">
                        <input type="checkbox"
                               wire:key="filters.category-{{ $category->id }}"
                               wire:model="filters.category_id.{{ $category->id }}"
                               value="{{ $category->id }}"
                               @disabled(!in_array($category->id, array_keys($searchResult['facetDistribution']['category_id'])))
                        >
                        <label>{{ $category->name }}</label>
                    </div>
                @endforeach

            </div>

            <div>
                <h2 class="font-bold">Users</h2>
                @foreach($allUsers as $key => $user)
                    <div class="flex gap-2">
                        <input type="checkbox"
                               wire:key="filters.user-{{ $user->id }}"
                               wire:model="filters.user_id.{{ $user->id }}"
                               value="{{ $user->id }}"
                               @disabled(!in_array($user->id, array_keys($searchResult['facetDistribution']['user_id'])))
                        >
                        <label>{{ $user->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Results --}}
    <div class="col-span-3">

        <div class="flex justify-between items-center">
            <div>
                S'han trobat {{ $searchResult['estimatedTotalHits'] }} resultats per la cerca
            </div>

        </div>

        <hr class="my-4">

        <div class="space-y-4">
            @foreach($searchResult['hits'] as $key => $post)
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h2 class="text-lg font-bold">{{ $post['id'] }} - {{ $post['title'] }}</h2>
                        <h3>By {{ $post['user_id'] }}</h3>
                        <h4 class="text-sm">Category: {{ $post['category_id'] }}</h4>
                    </div>
                    <div>
                        {!! $post['body'] !!}
                    </div>
                </div>
                <hr>
            @endforeach
        </div>

    </div>
</div>
