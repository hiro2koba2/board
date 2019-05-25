<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Auth;

class SearchPostWithTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        // タグのidが渡ってきてる。それと一致するものを持つポストをviewに返すことでOK
        // マーキングが効いてないシングルコントローラだから？ 一応動くけど重いかな
        $posts = Tag::find($id)->posts()->get();

        return view('search', ['posts' => $posts]);
    }
}
