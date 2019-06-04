<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;

class UserLikesPostsController extends Controller
{
    public function __invoke($id)
    {
        $user = User::find($id);

        $likes = $user->likes()->get()->sortByDesc('created_at');

        return view('userLike', ['likes' => $likes, 'user' => $user]);
    }
}
