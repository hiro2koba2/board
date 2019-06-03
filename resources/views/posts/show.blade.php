@extends('layouts.app')

@section('content')
    <div class="container text-brown3">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3 m-3">
                <h2 class="mb-3 mt-2">
                    {{ $post->title }}
                </h2>

                <div class="row justify-content-center mb-3">
                    <div class="col-md-6">
                        @if ( null !== $post->getFirstMedia('postImages') )
                            <img src="{{ $post->getFirstMedia('postImages')->getUrl('card') }}" width="" height="" alt="カフェの写真" class="round-circle mb-3">
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="row justify-content-left mb-2">
                            <div class="col-xs-6 pl-3">
                                <!-- いいね機能 -->
                                @if ($like)
                                {{ Form::model($post, array('action' => array('LikesController@unlike', $post->id, $like->id))) }}
                                {{ Form::hidden('_method','DELETE') }}
                                @csrf
                                    <button type="submit">
                                        Like {{ $post->likes_count }}
                                    </button>
                                {!! Form::close() !!}
                                @else
                                {{ Form::model($post, array('action' => array('LikesController@like', $post->id))) }}
                                    <button type="submit">
                                        Like {{ $post->likes_count }}
                                    </button>
                                {!! Form::close() !!}
                                @endif
                            </div>
                            <div class="col-xs-6 pl-2">
                                口コミ{{ $post->comments->count() }}
                            </div>
                        </div>

                        <h5>
                            @foreach($post->tags as $tag)
                                <span class="badge badge-brown text-brown4">{{$tag->name}}</span>
                            @endforeach
                        </h5>

                        <p class="mb-2">
                            <b>投稿本文：</b>{!! nl2br(e($post->body)) !!}
                        </p>

                        <address>
                            #123 St. Kansas City, MO<br/>
                            +34 1234 5678 <br/>
                            <a href="#">  name@email.com</a> <br/>
                            投稿者：{{ $post->user->name }} <br>
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

                                <button class="btn btn-danger mr-3">削除する</button>
                            </form>
                            <a href="{{ route('posts.edit', ['post' => $post]) }}">
                                <button class="btn btn-info">編集する</button>
                            </a>
                        @endcan
                    </div>
                </div>

                <section class="m-2">
                    <h2 class="h5 mb-4">
                        <b>口コミ</b>
                    </h2>

                    @forelse($post->comments as $comment)
                        <div class="border-top border-brown p-4">
                            <div class="row">
                                <div class="col-xs-2">
                                    <a href="{{ route('UserSearch', ['id' => $comment->user->id ])}}">
                                        @if ($comment->user->getFirstMedia('avatar') === null )
                                        <img src="/storage/noimage.png" alt="noimage" width="50" height="50" alt="" class="rounded-circle mr-1">
                                        @else
                                        <img src="{{ $comment->user->getFirstMedia('avatar')->getUrl('thumb') }}" width="50" height="50" alt="" class="rounded-circle mr-4">
                                        @endif

                                    </a>
                                    <!-- <p class="text-center"><b>{{ $comment->user->name }}</b></p> -->
                                </div>
                                <div class="col-xs-10">
                                    <p class="mt-1">
                                        {!! nl2br(e($comment->body)) !!}
                                    </p>
                                    <p>
                                        {{ $comment->created_at->format('Y.m.d H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <small class="text-secondary">口コミはまだありません。</small>
                    @endforelse
                </section>
                <form class="m-2" method="POST" action="{{ route('comments.store') }}">
                    @csrf

                    <input
                        name="post_id"
                        type="hidden"
                        value="{{ $post->id }}"
                    >

                    <div class="form-group">
                        <label for="body">
                            口コミ投稿フォーム
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
                        <button type="submit" class="btn btn-brown text-brown4">
                            コメントする
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
