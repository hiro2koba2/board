@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <!-- ここの処理のチェック必須 -->
                <div class="m-4">
                    <h5 class="text-brown3">
                    ユーザー検索：
                    @if( $user->getFirstMedia('avatar') === null)
                        <img src="/storage/noimage.png" alt="noimage" width="50" height="50" alt="" class="rounded-circle mr-1">の投稿
                    @else
                        <img src="{{ $user->getFirstMedia('avatar')->getUrl('thumb')  }}" width="50" height="50" alt="" class="rounded-circle mr-1">の投稿
                    @endif
                    </h5>
                </div>
                <div class="row justify-content-center">
                    @foreach($posts as $post)
                        <div class="col-lg-6">
                            <div class="card m-3 border-brown bg-brown4 text-brown3">
                                <div class="card-header">
                                    <h5><b>{{ $post->title }}</b></h5>
                                    <div class="text-left">
                                        <h5><b>
                                        Like{{$post->likes_count}}&nbsp;
                                        口コミ{{ $post->comments->count() }}
                                        </b></h5>
                                    </div>
                                </div>

                                <div class="card-header">
                                    <h5>
                                        @foreach($post->tags as $tag)
                                        <a href="{{ route('TagSearch', ['id' => $tag->id]) }}" class="badge badge-brown text-brown4">{{ $tag->name }}</a>
                                        @endforeach
                                    </h5>
                                </div>

                                <div class="card-body">
                                    @if ( null !== $post->getFirstMedia('postImages') )
                                        <img src="{{ $post->getFirstMedia('postImages')->getUrl('card') }}" width="" height="" alt="" class="round-circle mr-3">
                                    @endif
                                </div>
                                <div class="card-footer bg-brown text-right">
                                    <a class="card-link text-brown4" href="{{ route('posts.show', ['post' => $post]) }}">
                                        続きを読む
                                    </a>
                                </div>
                            </div>
                        </div>
                @endforeach
                </div>
        </div>

        <aside class="col-md-4 text-brown3">
            <!-- 認証ずみ -->
            @auth
                <div class="card">
                <!-- 新規のユーザーの場合などのための措置 -->
                @if ( null !== $user->getFirstMedia('avatar') )
                    <img class="card-img-top" src="{{ $user->getFirstMedia('avatar')->getUrl('card') }}" alt="Card image cap">
                @endif
                    <div class="card-body">
                        <h5 class="card-title">ユーザー名・{{ $user->name }}</h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            @endauth
            <!-- 認証してない場合 -->
            @guest
                <div class="m-4">ログインすれば詳しい<br>ユーザーの情報がわかります</div>
            @endguest
        </aside>

    </div>
</div>
@endsection
