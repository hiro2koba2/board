@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="border col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3 p-5 m-3 border-brown bg-brown4 text-brown3">
            <!-- @if (session('error'))
            <div class="alert alert-danger text-center" role="alert">
                {{ session('error')}}
            </div>
            @endif -->
            <h2 class="mb-5">
                <b>プロフィール</b>
            </h2>
            <h3 class="card-title my-3"><b>ユーザー名：</b>{{ auth()->user()->name }}</h3>

            <a href="{{ route('UserSearch', ['id' => auth()->user()->id ]) }}" class="btn btn-primary my-3">{{ auth()->user()->name }}の投稿一覧</a><br/>
            <a href="{{ route('UserLikes', ['id' => auth()->user()->id ])}}" class="btn btn-primary my-3">{{ auth()->user()->name }}がいいねをつけた記事一覧</a><br/>

            <form action="{{ route('avatar.store')}}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="form-group my-3">
                    <label>
                        プロフィール画像をここで変更できます
                    </label>

                    <input type="file" name="avatar" class="form-control {{ $errors->has('avatar') ? 'is-invalid' : '' }}">
                    @if ($errors->has('avatar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('avatar') }}
                        </div>
                    @endif
                </div>

                <input type="submit" value="Upload" class="btn btn-success">
            </form>
            <br>

        </div>
    </div>
</div>
@endsection
