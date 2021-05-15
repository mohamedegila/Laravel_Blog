<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //login View
    public function login()
    {
        return view('Admin.login');
    }

    // Submit Login
    public function submitLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'

        ]);
    
        $remember = request()->has('remember')?true:false;
        if (Auth::guard('webadmin')->attempt(['email' => request('email'), 'password' => request('password')], $remember)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with('error', 'Invalid username/password');
        }
    }

    //Dashboard
    public function dashboard()
    {
        $posts_count = Post::count();
        $activePosts_count      = Post::where('status', 1)->count();
        $inactivePosts_count    = Post::where('status', 0)->count();
        $activeComments_count   = Comment::where('status', 1)->count();
        $inactiveComments_count = Comment::where('status', 0)->count();
        //dd($inactiveComments_count);
        $comments_count = Comment::count();
        $users_count = User::count();
        $categories_count = Category::count();
        $posts=Post::where('status', 1)->orderBy('id', 'desc')->get();
        $info = ['posts_count'          =>$posts_count,
                 'categories_count'     =>$posts_count,
                 'users_count'          =>$users_count,
                 'comments_count'       =>$comments_count,
                 'activePosts_count'    =>$activePosts_count,
                 'inactivePosts_count'  =>$inactivePosts_count,
                 'activeComments_count'    =>$activeComments_count,
                 'inactiveComments_count'  =>$inactiveComments_count
                ];
        return view(
            'Admin.dashboard',
            [
            'posts'=>$posts,
            'info'=>$info,
            'title'=>'Dashboard'
        ]
        );
    }

    // Show all users
    public function users()
    {
        $data=User::orderBy('id', 'desc')->get();
        return view('Admin.user.index', ['data'=>$data]);
    }

    public function delete_user($id)
    {
        User::where('id', $id)->delete();
        return redirect('admin/user');
    }

    // Logout
    public function logout()
    {
        Auth::guard('webadmin')->logout();
        return redirect()->route('admin.login');
    }
}
