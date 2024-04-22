<style>
    .post-image {
        max-width: 100%; /* Largeur maximale de l'image */
        height: 200px; /* Hauteur au survol */
        margin-bottom: 20px; /* Espacement en bas de l'image */
        transition: height 3s ease-in-out; /* Transition pour le changement de hauteur */
    }

    .post-image:hover {
        height: 500px; /* Hauteur automatique pour maintenir les proportions */
    }
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
<header class="bg-gray-100 shadow-md">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between">
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
                </a>
            </div>
            <nav class="flex flex-1 justify-end space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-header">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-header">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-header">Register</a>
                    @endif
                @endauth
            </nav>
        </div>
    </div>
</header>