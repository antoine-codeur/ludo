<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse ($posts as $post)
                @include('posts.show_post', ['post' => $post])
            @empty
                <div class="col-span-full text-gray-600">Aucun post n'a été publié.</div>
            @endforelse
        </div>
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
