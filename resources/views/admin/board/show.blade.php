@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="container mt-4">
        <div class="border p-4">
            <div class="mb-4 text-right">
                <a href="{{ url('admin/dashboard') }}">Return</a>
                <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">
                    To Edit
                </a>
                <form style="display: inline-block;" method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">@csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
            <h1 class="h5 mb-4">
                {{ $post->title }}
            </h1>

            <p class="mb-5">
                {!! nl2br(e($post->body)) !!}
            </p>

            <section>
                <h2 class="h5 mb-4">
                    Comment
                </h2>

                @forelse($post->comments as $comment)
                    <div class="border-top p-4">
                        <time class="text-secondary">
                            {{ $comment->created_at->format('Y.m.d H:i:s') }}
                        </time>
                        <p class="mt-2">
                            {!! nl2br(e($comment->body)) !!}
                        </p>
                    </div>
                @empty
                    <p>There are no comments yet.</p>
                @endforelse
            </section>
        </div>
        <form class="mb-4" method="POST" action="{{ route('comments.store') }}">@csrf
            <input
                name="post_id"
                type="hidden"
                value="{{ $post->id }}"
            >

            <div class="form-group">
                <label for="body">
                    Text
                </label>

                <textarea
                    id="body"
                    name="body"
                    class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                    rows="4"
                >{{ old('body') }}</textarea>
                @if ($errors->has('body'))
                    <div class="invalid-feedback">
                        {{ $errors->first('body') }}
                    </div>
                @endif
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    To Comment
                </button>
            </div>
        </form>

    </div>
</div>    
@endsection
