@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has('error'))
        <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif
    <form action="{{ route('avatar.store')}}" method="post" enctype="multipart/form-data">
    <!-- enctypeとは？ -->
        @csrf

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" name="avatar" class="custom-file-input" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
            <input type="submit" value="Upload" class="btn btn-success ml-4">
        </div>

    </form>


    <div class="card-columns">
        @foreach($avatars as $avatar)
            <div class="card">
                <img class="card-img-top" src="{{ $avatar->getUrl() }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection