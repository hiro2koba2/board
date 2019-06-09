@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3 bg-brown4 text-brown3">
            @if (session('error'))
            <div class="alert alert-danger text-center" role="alert">
                {{ session('error')}}
            </div>
            @endif
            <h3 class="card-title my-3"><b>ユーザー名：{{ auth()->user()->name }}</b></h3>

            <form action="{{ route('avatar.store')}}" method="post" enctype="multipart/form-data" class="border border-brown" >
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
            <a href="{{ route('UserSearch', ['id' => auth()->user()->id ]) }}" class="btn btn-primary my-3">{{ auth()->user()->name }}の投稿一覧</a>&nbsp;&nbsp;
            <a href="{{ route('UserLikes', ['id' => auth()->user()->id ])}}" class="btn btn-primary my-3">{{ auth()->user()->name }}が<i class="fas fa-heart"></i>をつけた記事一覧</a>

        </div>
    </div>
</div>
@endsection
