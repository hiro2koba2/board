@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3">
            <!-- ログイン中のユーザーとポスト毎のユーザーを比較 if で表示非表示を切り替える -->
            @if (session('error'))
            <div class="alert alert-danger text-center" role="alert">
                {{ session('error')}}
            </div>
            @endif

            <form action="{{ route('avatar.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <input type="file" name="avatar" id="inputGroupFile01">
                    <input type="submit" value="Upload" class="btn btn-success ml-4">
            </form>
            @if ( null !== auth()->user()->getFirstMedia('avatar') )
            <div class="card bg-brown4 text-brown3">
            <!-- 新規のユーザーの場合などのための措置 -->
            <!-- 問題は画像の大きさ -->
                <img class="card-img-top" src="{{ auth()->user()->getFirstMedia('avatar')->getUrl('card') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ auth()->user()->name }}</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
            @else
            <p>プロフィール画像を設定してください。</p>
            @endif
        </div>
    </div>
</div>
@endsection
