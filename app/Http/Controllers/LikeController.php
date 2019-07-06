<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Like;
use Auth;

class LikeController extends Controller
{
    // いいねをつける
    public function like(Request $request, $postId)
    {
        Like::create([
            'user_id' => Auth::id(),
            'post_id' => $postId
        ]);

        $post = Post::findOrFail($postId);

        return redirect()->route('posts.show', ['post' => $post]);
    }

    // いいねを解除
    public function unlike($postId, $likeId)
    {
        // 二つid受け取るので区別しやすく　どのポストのどのいいねなのかを判別している
        $post = Post::findOrFail($postId);

        // like_by()でログインしているユーザーのidからどのいいねかを見つける
        // この実装だとlikeは付け替えるのではなく都度削除している 多対多でやるのと比べてどちらが良いのか？
        $post->like_by()->findOrFail($likeId)->delete();

        return redirect()
            ->action('PostController@show', $post->id);
    }
}
