@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="border col-md-offset-3 col-md-6 p-5 m-3 border-brown bg-brown4 text-brown3">
            <h1 class="h5 mb-4">
                投稿の新規作成
            </h1>

            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <fieldset class="mb-4">
                    <div class="form-group">
                        <label for="title">
                            タイトル
                        </label>
                        <input
                            id="title"
                            name="title"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                            value="{{ old('title') }}"
                            type="text"
                        >
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="tag">
                            タグ
                        </label>
                        <!-- オールドヘルパーがタグだけ効いてない laravelcollectiveを入れるべきか -->
                        @foreach ($tags as $tag)
                            <input
                                type="checkbox"
                                name="tags[]"
                                value="{{ $tag->id }}"
                            >
                            {{$tag->name}}
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="body">
                            本文
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

                    <div class="form-group mb-3">
                        <label for="image">
                            カフェ画像
                        </label>

                        <input type="file" name="cafeimage" id="inputGroupFile01">
                        @if ($errors->has('cafeimage'))
                            <div class="invalid-feedback">
                                {{ $errors->first('cafeimage') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger text-center" role="alert">
                                {{ session('error')}}
                            </div>
                        @endif

                        <!-- セットした段階で何かしら表示されないと良くない　改善余地 -->
                    </div>

                    <div class="mt-5">
                        <a class="btn btn-secondary" href="{{ route('index') }}">
                            キャンセル
                        </a>

                        <button type="submit" class="btn btn-primary">
                            投稿する
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection
