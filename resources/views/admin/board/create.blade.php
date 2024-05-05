@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                Create a New Post
            </h1>

            <form method="POST" action="{{ route('posts.store') }}">
                @csrf

                <fieldset class="mb-4">
                    <div class="form-group">
                        <label for="title">
                            Title
                        </label>
                        <input
                            id="title"
                            name="title"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                            value="{{ old('title') }}"
                            type="text"
                        >
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>

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
                        <label for="body">
                            User Name
                        </label>

                        <input
                            id="admin_id"
                            name="admin_id"
                            class="form-control {{ $errors->has('admin_id') ? 'is-invalid' : '' }}"
                            type="text"
                            value="{{ Auth::guard('admin')->user()->id }}"
                        >{{ Auth::guard('admin')->user()->name }}
                        
                    </div>

                    <div class="mt-5">
                        <a class="btn btn-secondary" href="{{ route('top-board') }}">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Post
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>


</div>
@endsection