<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class UsersPostSearchController extends Controller
{
    public function __invoke($id)
    {
        // ユーザーの名前から検索する形でポストを取得
        $posts = User::find($id)->posts()->get()->sortByDesc('created_at');

        return view('user', ['posts' => $posts ]);
    }
}
