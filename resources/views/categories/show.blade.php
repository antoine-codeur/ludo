<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts for') }} {{ $category->name }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($posts as $post)
                @include('components.posts')
            @endforeach
        </div>
    </div>
</x-app-layout>
