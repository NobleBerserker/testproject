<div class="space-y-6">
    @foreach($posts as $post)
        <a href="{{ url('/post/' . $post->facebook_id) }}" class="block p-6 bg-white shadow rounded-lg">
            <p class="font-semibold">{{ $post->message }}</p>

            <div class="mt-2 text-gray-600 text-sm">
                Likes: {{ $post->likes }}
                Comments: {{ $post->comments }}
                Shares: {{ $post->shares }}
            </div>


            <p class="text-sm text-gray-500">
                {{ $post->created_time->format('d M Y H:i') }}
            </p>

        </a>
    @endforeach
</div>