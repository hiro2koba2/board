<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Like;
use Auth;

class LikesController extends Controller
{
    // いいねをつける
    public function like(Request $request, $postId)
    {
        Like::create(
            array(
                'user_id' => Auth::id(),
                'post_id' => $postId
            )
        );

        $post = Post::findOrFail($postId);

        return redirect()->route('posts.show', ['post' => $post]);
    }

    // いいねを解除
    public function unlike($postId, $likeId)
    {
        $post = Post::findOrFail($postId);
        $post->like_by()->findOrFail($likeId)->delete();

        return redirect()
            ->action('PostsController@show', $post->id);
    }
}
