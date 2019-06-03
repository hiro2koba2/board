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
                            <h4><b>{{ $post->title }}</b></h4>
                            <div class="text-left">
                                <h5><b>Like{{$post->likes_count}}&nbsp;口コミ{{ $post->comments->count() }}</b></h5>
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

            <div class="d-flex justify-content-center mb-5">
                {{ $posts->links() }}
            </div>
        </div>

        <aside class="col-md-4 text-brown3">
            <div class="p-3 mb-3">
                <h4 class="font-italic">About</h4>
                <p class="mb-0">
                    カフェ情報投稿掲示板です。<br>
                    Laravelの勉強に作りました。<br>
                    <br>
                    <ul>
                        <li>タグ機能</li>
                        <li>いいね機能</li>
                        <li>画像投稿</li>
                    </ul>
                </p>
            </div>
        </aside>

    </div>
</div>
@endsection
