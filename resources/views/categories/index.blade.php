<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', ['category' => $category->id]) }}" class="relative overflow-hidden shadow-lg rounded-lg cursor-pointer transition duration-500 ease-in-out hover:scale-105">
                    <div class="bg-cover bg-center h-64" style="background-image: url('{{ $category->image_url }}');"></div>
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-4">
                        <h3 class="text-xl font-bold text-white">{{ $category->name }}</h3>
                        <p class="text-white">{{ $category->posts->count() }} posts</p>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center p-4 bg-black bg-opacity-0 opacity-0 hover:bg-opacity-75 hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-center">{{ $category->description ?: 'No description available.' }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
