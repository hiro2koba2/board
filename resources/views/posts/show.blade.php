@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                {{ $post->title }}
            </h1>

            <p class="mb-5">
                {!! nl2br(e($post->body)) !!}
            </p>

            <form
                style="display: inline-block;"
                method="POST"
                action="{{ route('posts.destroy', ['post' => $post]) }}"
                class="mb-5"
            >
                @csrf
                @method('DELETE')

                <button class="btn btn-danger">削除する</button>
            </form>
            <a href="{{ route('posts.edit', ['post' => $post]) }}">
                <button class="btn btn-info">編集する</button>
            </a>



            <form class="mb-4" method="POST" action="{{ route('comments.store') }}">
                @csrf

                <input
                    name="post_id"
                    type="hidden"
                    value="{{ $post->id }}"
                >

                <div class="form-group">
                    <label for="body">
                        本文
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
                        コメントする
                    </button>
                </div>
            </form>

            <section>
                <h2 class="h5 mb-4">
                    コメント
                </h2>

                @forelse($post->comments as $comment)
                    <div class="border-top p-4">
                        <time class="text-secondary">
                            {{ $comment->created_at->format('Y.m.d H:i') }}
                        </time>
                        <p class="mt-2">
                            {!! nl2br(e($comment->body)) !!}
                        </p>
                    </div>
                @empty
                    <p>コメントはまだありません。</p>
                @endforelse
            </section>
        </div>
    </div>
@endsection