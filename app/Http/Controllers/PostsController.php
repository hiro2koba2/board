<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Tag;
use Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);

        return view('posts.index', ['posts' => $posts ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', ['tags' => Tag::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:1000',
        ]);
        // バリデーションも移すべきか

        $id = Auth::id();

        $params += array('user_id' => $id);

        $post = Post::create($params);

        $post->tags()->sync($request->tags);
        // tags()以降がタグ付与の設定

        $post->addMedia($request->cafeimage)->toMediaCollection('postImages');
        // メディアライブラリに追加

        return redirect()->route('index');
        // これで名前をつけたルートに飛べる
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show',[
            'post' => $post,
            // 'tags' => Tag::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // 全てのタグをここでも表示できるように取り出す
        return view('posts.edit', [
            'post' => $post,
            'tags' => Tag::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $post = Post::findOrFail($id);

        $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:1000',
        ]);

        // 更新処理に問題あり

        // ここが肝　全てを書き換えるわけではない　だからユーザー情報をいじる必要はない　タグはsyncを使う必要ある
        $post->fill($params)->save();

        $post->tags()->sync($request->tags);

        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        \DB::transaction(function () use ($post) {
            $post->comments()->delete();
            $post->delete();
        });

        return redirect()->route('index');
    }
}
