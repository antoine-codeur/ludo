<div class="post bg-white rounded-lg shadow my-4 relative"> 
    @if ($post->image_url)
        <div class="bg-gray-800 rounded-t-lg">
            <img class="w-full h-64 object-cover rounded-t-lg" src="{{ $post->image_url }}" alt="Post image">
        </div>
        <div class="absolute top-0 left-0 m-2">
            <div x-data="{ open: false }">
                <button @click="open = !open" class="focus:outline-none p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition">
                    <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>  
                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" class="z-50 mt-2 py-1 w-48 bg-white rounded-md shadow-xl border border-gray-100">
                    <a href="{{ route('posts.show', $post) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View Post</a>
                    @if (Auth::check() && (Auth::user()->isAdmin() || $post->user_id === Auth::id()))
                        <a href="{{ route('posts.edit', $post) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('delete-post-form-{{ $post->id }}').submit();">Delete</a>
                        <form id="delete-post-form-{{ $post->id }}" action="{{ route('posts.destroy', $post) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Share</a>
                </div>
            </div>
        </div>
    @else
        <!-- Dropdown Button -->
        <div class="m-2">
            <div x-data="{ open: false }">
                <button @click="open = !open" class="focus:outline-none p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition">
                    <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>       
                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" class="absolute z-50 mt-2 py-1 w-48 bg-white rounded-md shadow-xl border border-gray-100">
                    <a href="{{ route('posts.show', $post) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View Post</a>
                    @if (Auth::check() && (Auth::user()->isAdmin() || $post->user_id === Auth::id()))
                        <a href="{{ route('posts.edit', $post) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('delete-post-form-{{ $post->id }}').submit();">Delete</a>
                        <form id="delete-post-form-{{ $post->id }}" action="{{ route('posts.destroy', $post) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif

                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Share</a>
                </div>
            </div>
        </div>
    @endif
    <div class="p-4">
        <h2 class="font-bold text-xl mb-2">{{ $post->title }}</h2>
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
            <small class="text-gray-500">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small>
        </div>
    </div>
</div>