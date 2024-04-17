<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts for') }} {{ $category->name }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($posts as $post)
                <!-- Afficher les détails du post ici -->
                <div class="post-card bg-white rounded-lg shadow-lg overflow-hidden my-4">
                    <h2 class="font-bold text-xl mb-2">{{ $post->title }}</h2>
                    <div class="mt-4 mb-2 text-gray-600">{{ $post->content }}</div>
                    <img src="{{ $post->image_url }}" alt="Image">
                    <div class="p-4">
                        <p class="text-gray-700 text-base">{{ $post->description }}</p>
                        <small class="text-gray-500">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination links -->
        {{ $posts->links() }}
    </div>
</x-app-layout>
