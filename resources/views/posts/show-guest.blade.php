<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $post->title }}</title> <!-- Titre de la page basé sur le titre du post -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('components.home-header')

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
                                        <span href="{{ route('categories.show', $category->id) }}"
                                        class="inline-block bg-gray-200 hover:bg-gray-300 rounded-full px-3 py-1 text-sm {{ $category->is_valid ? 'font-semibold' : 'font-normal' }} text-gray-700 mr-2 mb-2 transition duration-150 ease-in-out">
                                            #{{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                                <small class="text-gray-500">Posté par {{ $post->user->name }} le {{ $post->created_at->format('d/m/Y') }}</small>
                            </div>
                        </div>
                    </div>
                    <!-- Fin du post -->
        </div>
    </div>

    <!-- Bouton de retour à l'accueil -->
    <div class="fixed bottom-4 right-4">
        <a href="{{ route('home') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-full transition duration-300">Retour à l'accueil</a>
    </div>

    @include('components.home-footer')

    <!-- Script pour gérer la barre de navigation fixe -->
    <script>
        window.addEventListener('scroll', function() {
            var header = document.querySelector('header');
            if (window.scrollY > 0) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
