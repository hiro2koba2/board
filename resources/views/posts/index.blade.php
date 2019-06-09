@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- アイキャッチ -->
    <div class="text-center py-4 text-brown3">
        <b>
            <p>カフェ画像投稿掲示板（タグ機能、いいね機能、画像投稿機能）</p>
            <p>Laravelの勉強に作りました。</p>
        </b>
    </div>

    <!-- カフェカード -->
    <div class="row justify-content-center">
        @foreach($posts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card m-3 border-brown bg-brown4 text-brown3">
                    <div class="card-header">
                        <h5><b>
                            {{ $post->title }}&nbsp;

                            <i class="fas fa-heart"></i>{{$post->likes_count}}&nbsp;
                            <i class="fas fa-comments"></i>{{ $post->comments->count() }}
                        </b></h5>
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
                        <!-- card-linkはあると下線を消してくれるので残す -->
                        <a class="card-link text-brown4" href="{{ route('posts.show', ['post' => $post]) }}">
                            続きを読む
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mb-5">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
