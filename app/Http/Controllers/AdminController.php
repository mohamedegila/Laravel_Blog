<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
            'username' => 'required',
            'password' => 'required'

        ]);
        
        //$admins = Admin::all();
        // dd(Admin::where(['username' => $request->username , 'password' => $request->password]));
        $userCheck = Admin::where(['username'=>$request->username,'password'=>$request->password])->count();
        //  dd($userCheck);
        if ($userCheck > 0) {
            $adminData=Admin::where(['username'=>$request->username,'password'=>$request->password])->first();
            session(['adminData'=>$adminData]);
            return redirect('admin/dashboard');
        } else {
            return redirect('admin/login')->with('error', 'Invalid username/password');
        }
    }

    //Dashboard
    public function dashboard()
    {
        $posts_count = Post::count();
        $activePosts_count = Post::where('status', 1)->count();
        $inactivePosts_count = Post::where('status', 0)->count();

        $comments_count = Comment::count();
        $users_count = User::count();
        $categories_count = Category::count();
        $posts=Post::where('status', 1)->orderBy('id', 'desc')->get();
        $info = ['posts_count'          =>$posts_count,
                 'categories_count'     =>$posts_count,
                 'users_count'          =>$users_count,
                 'comments_count'       =>$comments_count,
                 'activePosts_count'    =>$activePosts_count,
                 'inactivePosts_count'  =>$inactivePosts_count
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

    // Logout
    public function logout()
    {
        session()->forget(['adminData']);
        return redirect('admin/login');
    }
}
