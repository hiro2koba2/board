<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Auth;

class SearchPostWithTagController extends Controller
{
    public function __invoke($id)
    {
        // タグのidが渡ってきてる。それと一致するものを持つポストをviewに返すことでOK コレクションを降順に
        $posts = Tag::find($id)->posts()->get()->sortByDesc('created_at')->paginate();

        // タグの名前をここで出して、そのまま渡す
        $name = Tag::find($id)->name;

        return view('search', ['posts' => $posts, 'name' => $name]);
    }
}
