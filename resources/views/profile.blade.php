@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3">
            <!-- ログイン中のユーザーとポスト毎のユーザーを比較 if で表示非表示を切り替える -->
            <form action="{{ route('avatar.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="avatar" class="custom-file-input" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">画像を選択してください</label>
                    </div>
                    <input type="submit" value="Upload" class="btn btn-success ml-4">
                </div>

            </form>
            <div class="card">
            <!-- 新規のユーザーの場合などのための措置 -->
            <!-- 問題は画像の大きさ -->
            @if ( null !== auth()->user()->getFirstMedia('avatar') )
                <img class="card-img-top" src="{{ auth()->user()->getFirstMedia('avatar')->getUrl('card') }}" alt="Card image cap">
            @endif
                <div class="card-body">
                    <h5 class="card-title">Avatar</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection