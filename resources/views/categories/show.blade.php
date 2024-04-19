<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Posts ') }} {{ $category->name }}
            </h2>
            <div class="flex space-x-4">
                @if(Auth::user()->isAdmin())
                    <form method="POST" action="{{ route('categories.destroy', ['category' => $category->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this category?')" class="text-red-600 hover:text-red-800">Delete Category</button>
                    </form>
                @endif
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="text-blue-600 hover:text-blue-800">Edit Category</a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse ($posts as $post)
                @include('components.posts', ['post' => $post])
            @empty
                <div class="col-span-full text-center text-gray-600">No posts available.</div>
            @endforelse
        </div>
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
