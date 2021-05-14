<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Show all comments
    public function index()
    {
        $data=Comment::orderBy('id', 'desc')->get();
        return view('Admin.comment.index', ['data'=>$data]);
    }

    public function delete_comment($id)
    {
        Comment::where('id', $id)->delete();
        return redirect()->route('admin.manage.comment');
    }

    public function active($id)
    {
        $comment = Comment::where('id', $id)->first();

        $comment->status=1;
        $comment->save();

        return redirect()->route('admin.manage.comment');
    }

    public function inactive($id)
    {
        $comment = Comment::where('id', $id)->first();

        $comment->status=0;
        $comment->save();

        return redirect()->route('admin.manage.comment');
    }
}
