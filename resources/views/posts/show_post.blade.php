<div class="post">
    <h2>{{ $post->title }}</h2>
    <img src="{{ $post->image_url }}" alt="Image" style="width: 100%; max-height: 300px; object-fit: cover;">
    <p>{{ $post->description }}</p>
    <div>{{ $post->content }}</div>
    <small>Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small>
</div>
