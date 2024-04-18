<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts ') }} {{ $category->name }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse ($posts as $post)
                @include('components.posts', ['post' => $post])
            @empty
                <div class="col-span-full text-center text-gray-600">No posts available.</div>
            @endforelse
        </div>
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
