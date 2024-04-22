<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        header {
            transition: height 1.2s ease, box-shadow 1.2s ease;
            position: sticky;
            top: 0;
            z-index: 1000;
            height: 100px;
        }

        .scrolled {
            height: 60px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .container {
            padding-top: 20px;
            padding-bottom: 20px;
            transition: all 1.1s ease;
        }
        .scrolled .container {
            padding-top: 0;
            padding-bottom: 0;
        }

        svg {
            transition: max-height 1.2s ease;
            max-height: 60px;
        }
    </style>
</head>
<body class="bg-gray-100">
    @include('components.home-header')

    <section class="container mx-auto py-8">
        <!-- Première section : Présentation du blog Ludo -->
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-4">Bienvenue sur le blog Ludo</h2>
            <p class="text-lg text-gray-700 mb-8">Découvrez les dernières actualités, partagez vos idées et explorez le monde avec nous.</p>
        </div>

        <!-- Deuxième section : Derniers posts -->
        <h2 class="text-3xl font-bold mb-4">Derniers posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Boucle sur les derniers posts pour les afficher -->
            @forelse ($latestPosts as $post)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ $post->image_url }}" alt="{{ $post->title }}">
                    <div class="p-4">
                        <h3 class="text-xl font-bold mb-2">{{ $post->title }}</h3>
                        <p class="text-gray-700">{{ $post->excerpt }}</p>
                        <a href="{{ route('posts.show', $post) }}" class="mt-2 block text-blue-500 hover:underline">Lire la suite</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-gray-600">Aucun post n'a été publié.</div>
            @endforelse
        </div>

        <!-- Troisième section : Call to action pour s'inscrire -->
        <div class="text-center mt-8">
            <h2 class="text-3xl font-bold mb-4">Rejoignez-nous dès maintenant !</h2>
            <p class="text-lg text-gray-700 mb-8">Inscrivez-vous dès aujourd'hui pour accéder à tous nos contenus exclusifs.</p>
            <a href="{{ route('register') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-full transition duration-300">S'inscrire</a>
        </div>
    </section>

    @include('components.home-footer')

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