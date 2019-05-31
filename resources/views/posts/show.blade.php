@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3">
                <div class="border p-4">
                    <h2 class="mb-3">
                        {{ $post->title }}
                        <!-- 太字にしてみるかな -->
                    </h2>

                    @if ( null !== $post->getFirstMedia('postImages') )
                    <img src="{{ $post->getFirstMedia('postImages')->getUrl('card') }}" width="" height="" alt="カフェの写真" class="round-circle mb-3">
                    @endif

                    <div class="mb-4">
                        @foreach($post->tags as $tag)
                        <p class="badge badge-pill badge-info">{{$tag->name}}</p>
                        @endforeach
                    </div>

                    <p class="mb-4">
                        <b>投稿本文：</b>{!! nl2br(e($post->body)) !!}
                    </p>

                    <address>
                        #123 St. Kansas City, MO<br/>
                        +34 1234 5678 <br/>
                        <a href="#">  name@email.com</a> <br/>
                    </address>

                    @can('update', $post)
                    <!-- ポリシーでチェックしてOKなら表示　所有者なら -->
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
                    @endcan

                    <section>
                        <h2 class="h5 mb-4">
                            <b>コメント</b>
                        </h2>

                        @forelse($post->comments as $comment)
                            <div class="border-top p-4">
                                <p class="mt-1">
                                    {!! nl2br(e($comment->body)) !!}
                                </p>
                                <p class="text-right">
                                    {{ $comment->created_at->format('Y.m.d H:i') }}
                                </p>
                            </div>
                        @empty
                            <p>コメントはまだありません。</p>
                        @endforelse
                    </section>


                    @auth
                        <form class="mb-4" method="POST" action="{{ route('comments.store') }}">
                            @csrf

                            <input
                                name="post_id"
                                type="hidden"
                                value="{{ $post->id }}"
                            >

                            <div class="form-group">
                                <label for="body">
                                    コメント本文
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
                    @endauth

                </div>
            </div>
        </div>
    </div>
@endsection