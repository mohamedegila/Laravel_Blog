<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
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
    public function detail(Request $request, $slug, $post_id)
    {
        Post::find($post_id)->increment('views');
        $post = Post::find($post_id);

        return view('detail', ['detail'=>$post]);
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
        $posts=Post::where('cat_id', $cat_id)->orderBy('id', 'desc')->paginate(2);
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
        $request->validate([
            'comment'=>'required'
        ]);

        $comment = new Comment;

        $comment->user_id = $request->user()->id;
        $comment->post_id = $post_id;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect('detail/'.$slug.'/'.$post_id)->with('success', 'Comment has been submitted.');
    }


    // User submit post
    public function save_post_form()
    {
        $cats=Category::all();
        return view('save-post-form', ['cats'=>$cats]);
    }

    // Save Data
    public function save_post_data(Request $request)
    {
        $setting = Admin::select(
            'user_auto',
        )
        ->where('id', 1)->first();
        $request->validate([
            'title'=>'required',
            'category'=>'required',
            'details'=>'required',
        ]);

        // Post Thumbnail
        if ($request->hasFile('post_thumb')) {
            $image1=$request->file('post_thumb');
            $reThumbImage=time().'.'.$image1->getClientOriginalExtension();
            $dest1=public_path('/imgs/thumb');
            $image1->move($dest1, $reThumbImage);
        } else {
            $reThumbImage='na';
        }

        // Post Full Image
        if ($request->hasFile('post_image')) {
            $image2=$request->file('post_image');
            $reFullImage=time().'.'.$image2->getClientOriginalExtension();
            $dest2=public_path('/imgs/full');
            $image2->move($dest2, $reFullImage);
        } else {
            $reFullImage='na';
        }

        $post=new Post;
        $post->user_id=$request->user()->id;
        $post->cat_id=$request->category;
        $post->title=$request->title;
        $post->thumb=$reThumbImage;
        $post->full_img=$reFullImage;
        $post->details=$request->details;
        $post->tags=$request->tags;

        if ($setting->user_auto == 1) {
            $post->status=1;
        }
       
        $post->save();

        return redirect('save-post-form')->with('success', 'Post has been added');
    }
}
