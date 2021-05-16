<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Services\post\PostById;
use App\Services\post\SavePost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display all posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $q=$request->q;
            $posts=Post::where('status', 1)->where('title', 'like', '%'.$q.'%')->orderBy('id', 'desc')->paginate(2);
        } else {
            $posts = Post::where('status', 1)->orderBy('id', 'desc')->paginate(5);
        }
        return view('home', ['posts'=>$posts]);
    }

    /**
    * Display post detail.
    *
    * @param  \Illuminate\Http\Request
    * @param  slug
    * @param  post_id
    * @return \Illuminate\Http\Response
    */
    public function detail(Request $request, $slug, $post_id, PostById $postService)
    {
        $post = $postService->execute($post_id);
        $comment_count = $post->comments->where('status', 1)->count();
        return view('detail', ['detail'=>$post,
                                'comment_counter'=>$comment_count]);
    }


    /**
     * Display all category.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_category()
    {
        $categories=Category::orderBy('id', 'desc')->paginate(5);
        return view('categories', ['categories'=>$categories]);
    }

    /**
    * Show category posts.
    *
    * @param  \Illuminate\Http\Request
    * @param  cat_slug
    * @param  cat_id
    * @return \Illuminate\Http\Response
    */

    public function category(Request $request, $cat_slug, $cat_id)
    {
        $category=Category::find($cat_id);
        $posts=Post::where('cat_id', $cat_id)->where('status', 1)->orderBy('id', 'desc')->paginate(2);
        return view('category', ['posts'=>$posts,'category'=>$category]);
    }
    /**
    * Save comment for specific post.
    *
    * @param  \Illuminate\Http\Request
    * @param  slug
    * @param  post_id
    * @return \Illuminate\Http\Response
    */
    public function save_comment(Request $request, $slug, $post_id)
    {
        $setting = Admin::select(
            'comment_auto',
        )
        ->where('id', 1)->first();
        $request->validate([
            'comment'=>'required'
        ]);

        $comment = new Comment;

        $comment->user_id = $request->user()->id;
        $comment->post_id = $post_id;
        $comment->comment = $request->comment;

        if ($setting->comment_auto == 1) {
            $comment->status=1;
        }
        $comment->save();
        return redirect('detail/'.$slug.'/'.$post_id)->with('success', $setting->comment_auto?'Comment has been submitted.':'Comment has been submitted waiting for admin acceptance.');
    }


    // User submit post
    public function save_post_form()
    {
        $cats=Category::all();
        return view('save-post-form', ['cats'=>$cats]);
    }

    // Save Data
    public function save_post_data(Request $request, SavePost $saveAdminPostService)
    {
        $saveAdminPostService->execute($request);

        return redirect('save-post-form')->with('success', 'Post has been added');
    }
}
