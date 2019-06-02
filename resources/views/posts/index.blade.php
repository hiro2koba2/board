@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="row justify-content-center">
            <!-- この中でさらに12等分と考えて colの数値を決める -->
            @foreach($posts as $post)
                <div class="col-lg-6">
                    <div class="card m-3 border-brown bg-brown4 text-brown3">
                        <div class="card-header">
                            <b>{{ $post->title }}</b>
                            <div class="text-right">口コミ{{ $post->comments->count() }}</div>
                        </div>

                        <div class="card-header">
                            @foreach($post->tags as $tag)
                            <a href="{{ route('TagSearch', ['id' => $tag->id]) }}" class="badge badge-brown text-brown4">{{ $tag->name }}</a>
                            @endforeach
                        </div>

                        <div class="card-body">
                            @if ( null !== $post->getFirstMedia('postImages') )
                                <img src="{{ $post->getFirstMedia('postImages')->getUrl('card') }}" width="" height="" alt="" class="round-circle mr-3">
                            @endif
                            <!-- @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif -->
                        </div>
                        <div class="card-footer bg-brown">
                            <!-- <span class="mr-2">
                                投稿日時 {{ $post->created_at->format('Y.m.d')}}
                            </span>
                            <span class="mr-2">
                                ユーザー名 <a href="{{ route('UserSearch', ['id' => $post->user->id ])}}">{{ $post->user->name }}</a>
                            </span> -->
                            <a class="card-link text-brown4" href="{{ route('posts.show', ['post' => $post]) }}">
                                続きを読む
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

            <div class="d-flex justify-content-center mb-5">
                {{ $posts->links() }}
            </div>
        </div>

        <aside class="col-md-4 text-brown3">
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
