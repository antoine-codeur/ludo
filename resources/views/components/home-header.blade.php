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