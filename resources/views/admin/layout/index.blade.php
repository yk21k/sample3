<div class="container mt-4">
    @foreach ($posts as $post)
        <div class="card mb-4">
            <div class="card-header">
               11 {{ $post->title }}&nbsp;Date {{ $post->created_at->format('Y.m.d') }}
            </div>
            <div class="card-body">
                <p class="card-text">
                    {!! nl2br(e(str_limit($post->body, 200))) !!}
                </p>
                <p>
                	Date {{ $post->created_at->format('Y.m.d') }}
                </p>

                <span class="mr-2">
                    Date {{ $post->created_at->format('Y.m.d') }}
                </span>

                @if ($post->comments->count())
                    <span class="badge badge-primary">
                        comment {{ $post->comments->count() }}
                    </span>
                @endif
            </div>
        </div>
    @endforeach
</div>        