<div class="space-y-6">
    @foreach($posts as $post)
        <a href="{{ url('/post/' . $post->facebook_id) }}" class="block p-6 bg-white shadow rounded-lg">
            <p class="font-semibold">{{ $post->message }}</p>

            <p class="text-sm text-gray-500">
                {{ $post->created_time->format('d M Y H:i') }}
            </p>

            @if($post->report)
                <div class="mt-2 text-gray-600 text-sm">
                    Likes: {{ $post->report->likes }}
                    Comments: {{ $post->report->comments }}
                    Shares: {{ $post->report->shares }}
                </div>
            @endif

        </a>
    @endforeach
</div>