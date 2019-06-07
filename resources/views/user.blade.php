@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-8 text-brown3">
                <div class="m-4">
                    <h5>
                    ユーザー検索：
                    <!-- 最初は全員プロフィール画像なしなので、エラーを出さないように -->
                    @if( $user->getFirstMedia('avatar') === null)
                        <img src="/storage/noimage.png" alt="noimage" width="50" height="50" alt="" class="rounded-circle mr-1">の投稿
                    @else
                        <img src="{{ $user->getFirstMedia('avatar')->getUrl('thumb')  }}" width="50" height="50" alt="" class="rounded-circle mr-1">の投稿
                    @endif
                    </h5>
                </div>
                <div class="row justify-content-center">
                @if(!empty($posts->first()))
                    @foreach($posts as $post)
                        <div class="col-lg-6">
                            <div class="card m-3 border-brown bg-brown4 text-brown3">
                                <div class="card-header">
                                    <h5><b>{{ $post->title }}</b></h5>
                                    <div class="text-left">
                                        <h5><b>
                                            <i class="fas fa-heart"></i>{{$post->likes_count}}&nbsp;
                                            <i class="fas fa-comments"></i>{{ $post->comments->count() }}
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
                @else
                    <p>{{$user->name}}の投稿はまだありません</p>
                @endif
                </div>
        </div>

        <aside class="col-md-4 text-brown3">
            <!-- 認証ずみ -->
            @auth
                <div class="p-3 mb-3">
                    <h4 class="font-italic">ユーザー名・{{ $user->name }}</h4>
                    <p class="mb-0">
                        <br>
                        <a href="{{ route('UserLikes', ['id' => $user->id ])}}">{{ $user->name }}のいいねした記事一覧</a>
                        <br>
                    </p>
                </div>
            @endauth
            <!-- 認証してない場合 -->
            @guest
                <div class="m-4">
                <h5 class="font-italic">ユーザー名・{{ $user->name }}</h5><br>
                ログインすれば<br>{{ $user->name }}がいいねした記事を見れます。
                </div>
            @endguest
        </aside>

    </div>
</div>
@endsection
