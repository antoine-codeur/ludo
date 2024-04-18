<div class="post bg-white rounded-lg shadow overflow-hidden my-4">
    @if ($post->image_url)
        <img class="w-full h-64 object-cover" src="{{ $post->image_url }}" alt="Post image">
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
