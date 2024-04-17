<div class="post bg-white rounded-lg shadow-lg overflow-hidden my-4">
    <h2 class="font-bold text-xl mb-2">{{ $post->title }}</h2>
    <div class="mt-4 mb-2 text-gray-600">{{ $post->content }}</div>
        <img src="{{ $post->image_url }}" alt="Image">
        <div class="p-4">
        <p class="text-gray-700 text-base">
            @foreach ($post->categories as $category)
                @if ($category->is_valid)
                    <strong>#{{ $category->name }}</strong>
                @else
                    #{{ $category->name }}
                @endif
            @endforeach
        </p>
        <small class="text-gray-500">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small>
    </div>
</div>
