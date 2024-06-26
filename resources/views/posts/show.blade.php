<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Début du post -->
                    <div class="post bg-white rounded-lg shadow my-4 relative">
                        @if ($post->image_url)
                            <div class="bg-gray-800 rounded-t-lg">
                                <img class="post-image w-full h-64 object-cover rounded-t-lg" src="{{ $post->image_url }}" alt="Post image">
                            </div>
                        @endif
                        <div class="p-4">
                            <h1 class="font-bold text-3xl mb-2">{{ $post->title }}</h1>
                            <p class="text-gray-600">{{ $post->content }}</p>
                            <div class="mt-4">
                                <div class="mb-2">
                                    @foreach ($post->categories as $category)
                                        <a href="{{ route('categories.show', $category->id) }}"
                                        class="inline-block bg-gray-200 hover:bg-gray-300 rounded-full px-3 py-1 text-sm {{ $category->is_valid ? 'font-semibold' : 'font-normal' }} text-gray-700 mr-2 mb-2 transition duration-150 ease-in-out">
                                            #{{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                                <small class="text-gray-500">Posté par {{ $post->user->name }} le {{ $post->created_at->format('d/m/Y') }}</small>
                            </div>
                        </div>
                    </div>
                    <!-- Fin du post -->
        </div>
    </div>
</x-app-layout>
