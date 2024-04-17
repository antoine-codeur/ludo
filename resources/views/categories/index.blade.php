<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($categories as $category)
                <a href="{{ route('show.categorie', ['category' => $category->id]) }}" class="category-card bg-cover bg-center relative overflow-hidden shadow-lg rounded-lg cursor-pointer" style="background-image: url('{{ $category->image_url }}'); height: 250px;">
                    <div class="bg-black bg-opacity-50 absolute inset-0 p-4 flex flex-col justify-end transition duration-500 ease-in-out transform hover:scale-105">
                        <div class="text-white">
                            <h3 class="text-xl font-bold">{{ $category->name }}</h3>
                            <p>{{ $category->posts->count() }} posts</p>
                        </div>
                        <div class="card-back absolute inset-0 flex items-center justify-center p-4 bg-black bg-opacity-75 scale-95 hover:scale-100 transition-transform duration-300 ease-in-out">
                            <p class="text-white text-center">{{ $category->description ?: 'No description available.' }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
