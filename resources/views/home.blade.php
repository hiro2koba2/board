@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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

        <div class="col-md-8">
            @foreach($posts as $post)
            <div class="card">
                <div class="card-header">
                    {{ $post->title }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    ログイン完了
                    <p class="card-text">
                        {!! nl2br(e(str-limit($post->body, 200))) !!}
                    </p>
                </div>
                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時 {{ $post->created_at->format('Y.m.d')}}
                    </span>
                    <span class="mr-2">
                        ユーザー名 {{ $post->user->name }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
