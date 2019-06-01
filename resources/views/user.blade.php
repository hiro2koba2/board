@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="m-4">
                <p>ユーザー検索：<img src="{{ $posts->first()->user->getFirstMedia('avatar')->getUrl('thumb')  }}" width="50" height="50" alt="" class="rounded-circle mr-1">の投稿</p>
            </div>
            <div class="row justify-content-center">
            @foreach($posts as $post)
                <div class="col-lg-6">
                    <div class="card m-3">
                        <div class="card-header">
                            <b>{{ $post->title }}</b>
                            <div class="text-right">口コミ{{ $post->comments->count() }}</div>
                        </div>

                        <div class="card-header">
                            @foreach($post->tags as $tag)
                            <a href="{{ route('TagSearch', ['id' => $tag->id]) }}" class="badge badge-pill badge-info">{{ $tag->name }}</a>
                            @endforeach
                        </div>

                        <div class="card-body">
                            <!-- @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif -->

                            @if ( null !== $post->getFirstMedia('postImages') )
                                <img src="{{ $post->getFirstMedia('postImages')->getUrl('card') }}" width="" height="" alt="" class="round-circle mr-3">
                            @endif
                        </div>
                        <div class="card-footer">
                            <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">
                                続きを読む
                            </a>
                            <!-- <span class="mr-2">
                                投稿日時 {{ $post->created_at->format('Y.m.d')}}
                            </span>
                            <span class="mr-2">
                                ユーザー名 {{ $post->user->name }}
                            </span> -->
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
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
