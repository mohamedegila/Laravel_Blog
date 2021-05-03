<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::all();
        return view('Admin.post.index', [
            'data'=>$data,
            'title'=>'All Posts',
            'meta_desc'=>'This is meta description for all categories'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Admin.post.add', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'details'=>'required',
            'category'=>'required'
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
        $post->user_id=1;
        $post->cat_id=$request->category;
        $post->title=$request->title;
        $post->thumb=$reThumbImage;
        $post->full_img=$reFullImage;
        $post->details=$request->details;
        $post->tags=$request->tags;
        $post->save();

        return redirect('admin/post/create')->with('success', 'Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Post::find($id);
        $categories = Category::all();
        return view('Admin.post.update', ['data'=>$data,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'details'=>'required',
            'category'=>'required'
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
        $post->user_id=1;
        $post->cat_id=$request->category;
        $post->title=$request->title;
        $post->thumb=$reThumbImage;
        $post->full_img=$reFullImage;
        $post->details=$request->details;
        $post->tags=$request->tags;
        $post->save();
        return redirect('admin/post/'.$id.'/edit')->with('success', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();
        
        
        if ($post->full_img !== "na") {
            $path = public_path('/imgs/full').'/'.$post->full_img;
            unlink($path);
        }
        
        if ($post->thumb !== "na") {
            $path = public_path('/imgs/thumb').'/'.$post->thumb;
            unlink($path);
        }
        $post->delete();
        return redirect('admin/post');
    }
}
