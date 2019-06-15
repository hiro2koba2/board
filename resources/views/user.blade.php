@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="m-4 text-brown3">
        <h5>
            <b><i class="fas fa-user"></i>ユーザー検索：</b>
            <!-- 最初は全員プロフィール画像なしなので、エラーを出さないように -->
            @if( $user->getFirstMedia('avatar') === null)
                <img src="/storage/noimage.png" alt="noimage" width="50" height="50" alt="" class="rounded-circle mr-1">の投稿
            @else
                <img src="{{ $user->getFirstMedia('avatar')->getUrl('thumb')  }}" width="50" height="50" alt="" class="rounded-circle mr-1">の投稿
            @endif

            <!-- ミドルウェアでログインしてない場合はリダイレクトするようにした -->
            <p class="mt-3"><b>ユーザー名・{{ $user->name }}</b></p>
            <a href="{{ route('UserLikes', ['id' => $user->id ])}}">{{ $user->name }}のいいねした記事一覧</a>

            <!-- 認証してない場合 -->
            <!-- @guest
                <p class="mt-3"><b>ユーザー名・{{ $user->name }}</b></p>
                <p class="mt-2">ログインで{{ $user->name }}がいいねした投稿を見れます。</p>
            @endguest -->

        </h5>
    </div>
    <div class="row justify-content-center">
        @if(!empty($posts->first()))
            @foreach($posts as $post)
                <div class="col-lg-4">
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

                        <img src="{{ $post->getFirstMedia('postImages')->getUrl('card') }}" class="card-img-top">

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

    @if(!empty($posts->first()))
        <div class="d-flex justify-content-center mb-5">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection
