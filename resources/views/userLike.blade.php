@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-8 text-brown3">
                <div class="m-4">
                    <h5>
                    <!-- 最初は全員プロフィール画像なしなので、エラーを出さないように -->
                        @if( $user->getFirstMedia('avatar') === null)
                        <b><img src="/storage/noimage.png" alt="noimage" width="40" height="40" alt="" class="rounded-circle mr-1">がいいねした投稿</b>
                        @else
                        <b><img src="{{ $user->getFirstMedia('avatar')->getUrl('thumb')  }}" width="40" height="40" alt="" class="rounded-circle mr-1">がいいねした投稿</b>
                        @endif
                    </h5>
                </div>
                <div class="row justify-content-center">
                @if(!empty($likes->first()))
                    @foreach($likes as $like)
                        <div class="col-lg-6">
                            <div class="card m-3 border-brown bg-brown4 text-brown3">
                                <div class="card-header">
                                    <h5>{{ $like->post->title }}</b></h5>
                                    <div class="text-left">
                                        <h5>
                                            <i class="fas fa-heart"></i>{{ $like->post->likes_count}}&nbsp;
                                            <i class="fas fa-comments"></i>{{ $like->post->comments->count() }}
                                        </b></h5>
                                    </div>
                                </div>

                                <div class="card-header">
                                    <h5>
                                        @foreach($like->post->tags as $tag)
                                        <a href="{{ route('TagSearch', ['id' => $tag->id]) }}" class="badge badge-brown text-brown4">{{ $tag->name }}</a>
                                        @endforeach
                                    </h5>
                                </div>

                                <img src="{{ $like->post->getFirstMedia('postImages')->getUrl('card') }}" class="card-img-top">

                                <div class="card-footer bg-brown text-right">
                                    <a class="card-link text-brown4" href="{{ route('posts.show', ['post' => $like->post]) }}">
                                        続きを読む
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>{{$user->name}}がいいねした投稿はまだありません</p>
                @endif
                </div>
        </div>

        <aside class="col-md-4 text-brown3">
            <!-- 認証ずみ -->
            @auth
                <div class="p-3 mb-3">
                    <h4 class="">ユーザー名・{{ $user->name }}</h4>
                    <p class="mb-0">
                        <br>
                        <a href="{{ route('UserSearch', ['id' => $user->id ]) }}">{{ $user->name }}の記事一覧</a>
                        <br>
                    </p>
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
