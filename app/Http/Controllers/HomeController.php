<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $q=$request->q;
            $posts=Post::where('title', 'like', '%'.$q.'%')->orderBy('id', 'desc')->paginate(2);
        } else {
            $posts = Post::orderBy('id', 'desc')->paginate(5);
        }
        return view('home', ['posts'=>$posts]);
    }
}
