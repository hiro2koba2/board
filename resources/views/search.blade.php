@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="m-3">
                <p>タグ検索：</p>
            </div>
            @foreach($posts as $post)
            <div class="card m-3">
                <div class="card-header">
                    {{ $post->title }}
                </div>

                <div class="card-header">
                    タグ：
                    @foreach($post->tags as $tag)
                    <a href="{{ route('search', ['id' => $tag->id]) }}" class="badge badge-secondary">{{ $tag->name }}</a>
                    @endforeach
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- ログイン完了 -->
                    <p class="card-text">
                        {!! nl2br(e(str_limit($post->body, 100))) !!}
                        <!-- 200字までを表示 改行も読み取れる -->
                    </p>
                    <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">
                        続きを読む
                    </a>
                </div>
                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時 {{ $post->created_at->format('Y.m.d')}}
                    </span>
                    <span class="mr-2">
                        ユーザー名 {{ $post->user->name }}
                    </span>
                </div>
            </div>
            @endforeach

        </div>

        <aside class="col-md-4">
            <div class="p-3 mb-3">
                <h4 class="font-italic">About</h4>
                <p class="mb-0">
                    ネットに残す
                </p>
            </div>
            <div class="p-3">
                <h4 class="font-italic">When</h4>
                <ol class="list-unstyled mb-0">
                    <li>
                        <a href="">March 2018</a>
                    </li>
                    <li>
                        <a href="">March 2018</a>
                    </li>
                    <li>
                        <a href="">March 2018</a>
                    </li>
                </ol>
            </div>
            <div class="p-3">
                <h4 class="font-italic">Elsewhere</h4>
                <ol class="list-unstyled mb-0">
                    <li>
                        <a href="">Github</a>
                    </li>
                    <li>
                        <a href="">Twitter</a>
                    </li>
                    <li>
                        <a href=""></a>
                    </li>
                </ol>
            </div>
        </aside>

    </div>
</div>
@endsection